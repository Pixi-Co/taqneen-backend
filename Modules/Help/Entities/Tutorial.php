<?php

namespace Modules\Help\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tutorial extends Model
{

    protected $table = "help_tutorial";

    protected $fillable = [
        'title_ar',    'description_ar',    'title_en',    
        'description_en',    'path_content',    'image',    
        'video',    'step',    'related_user_field',    
        'modal',    'position', 'animation', 'is_required', 
        'selector', 'page'
    ];

    protected $appends = [
        'image_url', 
        'video_url', 
        'modal_class', 
        'position_class'
    ];


    public static function getModalSizes()
    {
        return [
            "l" => "large",
            "m" => "meduim",
            "s" => "small",
            "f" => "full screen",
        ];
    }

    public static function getPosition()
    {
        return [
            'center',
            'topleft',
            'topright',
            'bottomleft',
            'bottomright'
        ];
    }

    public static function getAnimations()
    {
        return ["bounce","flash","pulse","rubberBand","shakeX","shakeY","headShake","swing","tada","wobble","jello","heartBeat","backInDown","backInLeft","backInRight","backInUp","backOutDown","backOutLeft","backOutRight","backOutUp","bounceIn","bounceInDown","bounceInLeft","bounceInRight","bounceInUp","bounceOut","bounceOutDown","bounceOutLeft","bounceOutRight","bounceOutUp","fadeIn","fadeInDown","fadeInDownBig","fadeInLeft","fadeInLeftBig","fadeInRight","fadeInRightBig","fadeInUp","fadeInUpBig","fadeInTopLeft","fadeInTopRight","fadeInBottomLeft","fadeInBottomRight","fadeOut","fadeOutDown","fadeOutDownBig","fadeOutLeft","fadeOutLeftBig","fadeOutRight","fadeOutRightBig","fadeOutUp","fadeOutUpBig","fadeOutTopLeft","fadeOutTopRight","fadeOutBottomRight","fadeOutBottomLeft","flip","flipInX","flipInY","flipOutX","flipOutY","lightSpeedInRight","lightSpeedInLeft","lightSpeedOutRight","lightSpeedOutLeft","rotateIn","rotateInDownLeft","rotateInDownRight","rotateInUpLeft","rotateInUpRight","rotateOut","rotateOutDownLeft","rotateOutDownRight","rotateOutUpLeft","rotateOutUpRight","hinge","jackInTheBox","rollIn","rollOut","zoomIn","zoomInDown","zoomInLeft","zoomInRight","zoomInUp","zoomOut","zoomOutDown","zoomOutLeft","zoomOutRight","zoomOutUp","slideInDown","slideInLeft","slideInRight","slideInUp","slideOutDown","slideOutLeft","slideOutRight","slideOutUp"];
    }

    public function isUserFieldDone()
    {
        return true;
       // return auth()->user()[$this->related_user_field] ? true : false;
    }

    public function getImageUrlAttribute() {
        return $this->image? url($this->image) : null;
    }

    public function getVideoUrlAttribute() {
        return $this->video? url($this->video) : null;
    }

    public function getModalClassAttribute() {
        $modal = "";

        if ($this->modal == 'l')
            $modal = "modal-lg";
        else if ($this->modal == 'm')
            $modal = "";
        else if ($this->modal == 's')
            $modal = "modal-sm";
        else if ($this->modal == 'f')
            $modal = "modal-fullscreen";
        
        return $modal;
    }

    public function getPositionClassAttribute() {
        return "w3-display-" . $this->position;
    }

    public static function getActive() {

        $usedId = UserTutorial::query()
            ->where('user_id', auth()->user()->id)
            ->pluck('tutorial_id')->toArray();

        $query = Tutorial::query()
        ->whereNotIn('id', $usedId);

        return $query;
    }

    public function isDone() { 
        $cols = explode(",", $this->related_user_field);
        if (count($cols) > 0 && $this->related_user_field) {
            $done = UserTutorial::where('tutorial_id', $this->id)->where('user_id', auth()->user()->id)->exists();

            foreach($cols as $col) {
                $user = json_decode(json_encode(auth()->user()->business->locations()->first()), true);
                if ($user[$col]) {
                    $done = $done && true;
                } else {
                    $done = $done && false;
                }
            } 

            $done = $done && (session('current_tutorial') == $this->id);

            return $done;
        } else {
            $done = UserTutorial::where('tutorial_id', $this->id)->where('user_id', auth()->user()->id)->exists();
            $done = $done || (session('current_tutorial') == $this->id);
            return $done;
        }
    }

    public static function endTutorial() {
        foreach(self::getActive()->get() as $item) {
            UserTutorial::create([
                "tutorial_id" => $item->id,
                "user_id" => auth()->user()->id,
            ]);
        }

        return true;
    }

    public function getNextId() {
        $nextStep = 0;
        if ($this->step < Tutorial::getActive()->max('step'))  
            $nextStep = $this->step + 1; 

        $next = Tutorial::getActive()->where('step', $nextStep)->orderBy('step')->first();  
        return optional($next)->id;
    }

    public function getPrevId() {
        $prevStep = 0;
        if ($this->step > 1)  
            $prevStep = $this->step - 1; 

        $prev = Tutorial::getActive()->where('step', $prevStep)->orderBy('step')->first();  
        return optional($prev)->id;
    }

    public static function getCurrentTutorial() {
        return session('current_tutorial')? session('current_tutorial') : optional(Tutorial::getActive()->orderBy('step')->first())->id;
    }

    public static function setCurrentTutorial($id) {
        session([
            'current_tutorial' => $id
        ]);
    }

    public static function isStarted() {
        return session('isStarted')? session('isStarted') : false;
    }
    
    public static function start() {
        session([
            'isStarted' => true
        ]); 
    }

    public static function autoload() {
        return view("help::tutorial.autoload");
    }

    public static function getTotalTutorial() {
        $total = self::getActive()->count();
        return $total;
    }

    public function getCurrentToturialWidthPercent() {
        $total = self::getTotalTutorial();
        return ($this->step / $total) * 100;
    }


}

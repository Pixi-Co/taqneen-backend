
<textarea 
    style="width: 97%!important"
    onchange="addToTransSaveList(this)"
    class="w3-input w3-round translation-input translation-{{ $translation->id }}" 
    data-id="{{ $translation->id }}"  >{{ $translation->trans }}</textarea>

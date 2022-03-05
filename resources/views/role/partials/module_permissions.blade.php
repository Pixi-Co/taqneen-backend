 @if(count($module_permissions) > 0)
  @php
    $module_role_permissions = [];
    if(!empty($role_permissions)) {
      $module_role_permissions = $role_permissions;
    }
  @endphp
  @foreach($module_permissions as $key => $value) 
  @can_bt([$key])
  <div class="row check_group"> 
    <div class="col-md-2">
      <div class="checkbox">
        <label > 
          {!! Form::checkbox('permissions[]', 'user.view', false, 
          [ 'class' => 'input-icheck check_all input-icheck']); !!} {{$key}}
        </label>
      </div>
    </div>
    <div class="col-md-9">
      @foreach($value as $module_permission)
      @php
        if(empty($role_permissions) && $module_permission['default']) {
          $module_role_permissions[] = $module_permission['value'];
        }
      @endphp
      <div class="col-md-12 {{ $key }}">
        <div class="checkbox">
          <label>
            {!! Form::checkbox('permissions[]', $module_permission['value'], in_array($module_permission['value'], $module_role_permissions), 
            [ 'class' => 'input-icheck']); !!} {{ $module_permission['label'] }}
          </label>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endcan_bt
  @endforeach
@endif

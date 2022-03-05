<br>
<button class="btn w3-green" onclick="createTree('#{{ $id }}')" >@trans('add')</button>
<button class="btn w3-deep-orange" onclick="renameTree('#{{ $id }}')" >@trans('edit')</button>
<button class="btn w3-red" onclick="deleteTree('#{{ $id }}')" >@trans('remove')</button>
<br>
<br>
<div id="{{ $id }}"></div>

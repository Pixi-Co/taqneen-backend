 
<!-- Main content -->
<section class="content new-content">
    @component('components.widget', ['class' => 'box-primary', 'title' => ''])
        @can('roles.create')
            @slot('tool')
                <div class="text-right">
                    <a class="add_btn" 
                    href="{{action('RoleController@create')}}" >
                    <i class="fa fa-plus"></i> @trans( 'messages.add' )</a>
                </div>
            @endslot
        @endcan
        @can('roles.view')
        <div class="table-responsive light-gray w3-border w3-border-light-gray"> 
            <table data-title="{{ __( 'user.roles' ) }} " class="custom-datatable table table-bordered table-striped" id="roles_table">
                <thead>
                    <tr>
                        <th>@trans( 'user.roles' )</th>
                        <th>@trans( 'messages.action' )</th>
                    </tr>
                </thead>
            </table>
        </div>
        @endcan
    @endcomponent

</section>
<!-- /.content -->

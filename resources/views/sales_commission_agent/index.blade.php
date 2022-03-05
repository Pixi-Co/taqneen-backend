 <!-- Main content -->
 <section class="content new-content">
     @component('components.widget', ['class' => 'box-primary'])
         @can('user.create')
             @slot('tool')
                 <div class="box-tools">
                     <button type="button" class="add_btn" data-href="{{ action('SalesCommissionAgentController@create') }}"
                         data-container=".commission_agent_modal"><i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
                 </div>
             @endslot
         @endcan
         @can('user.view')
             <div class="table-responsive light-gray w3-border w3-border-light-gray">
                 <table data-title="{{ __('lang_v1.sales_commission_agents') }}" class="table table-bordered table-striped"
                     id="sales_commission_agent_table">
                     <thead>
                         <tr>
                             <th>@trans( 'user.name' )</th>
                             <th>@trans( 'business.email' )</th>
                             <th>@trans( 'lang_v1.contact_no' )</th>
                             <th>@trans( 'business.address' )</th>
                             <th>@trans( 'lang_v1.cmmsn_percent' )</th>
                             <th>@trans( 'messages.action' )</th>
                         </tr>
                     </thead>
                 </table>
             </div>
         @endcan
     @endcomponent

     <div class="modal fade commission_agent_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
     </div>

     <div class="create_content hidden">
         @include('sales_commission_agent.create')
     </div>

 </section>
 <!-- /.content -->

 <script>
    setTimeout(function(){
      formAjax(false, function(){
        sales_commission_agent_table.ajax.reload();
      }, "#create_sale_commission_agent");
    }, 2000);
  </script>
  
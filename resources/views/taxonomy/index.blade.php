 @php
     $heading = !empty($module_category_data['heading']) ? $module_category_data['heading'] : __('category.categories');
     $navbar = !empty($module_category_data['navbar']) ? $module_category_data['navbar'] : null;
 @endphp

 <div class="page-title hidden">
     {{ $heading }}
 </div>


 @if (!empty($navbar))
     @include($navbar)
 @endif
 <!-- Content Header (Page header) -->
 <section class="content-header hidden">
     <h1>{{ $heading }}
         <small>
             {{ $module_category_data['sub_heading'] ?? __('category.manage_your_categories') }}
         </small>
         @if (isset($module_category_data['heading_tooltip']))
             @show_tooltip($module_category_data['heading_tooltip'])
         @endif
     </h1>
     <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
 </section>

 <!-- Main content -->
 <section class="content">
    <div class="">
        <button type="button" class="add_btn btn-modal"
            data-href="{{ action('TaxonomyController@create') }}?type={{ request()->get('type') }}"
            data-container=".category_modal">
            <i class="fa fa-plus"></i> @trans( 'messages.add' )</button>
    </div>
    
     @php
         $cat_code_enabled = isset($module_category_data['enable_taxonomy_code']) && !$module_category_data['enable_taxonomy_code'] ? false : true;
     @endphp
     <input type="hidden" id="category_type" value="{{ request()->get('type') }}">
     <div class="w3-display-container">
         


         <div class="table-responsive w3-light-gray">
             <table data-title="{{ $heading }}" class="table table-bordered table-striped" id="category_table">
                 <thead>
                     <tr>
                         <th>
                             @if (!empty($module_category_data['taxonomy_label']))
                             {{ $module_category_data['taxonomy_label'] }} @else @trans( 'category.category' )
                             @endif
                         </th>
                         @if ($cat_code_enabled)
                             <th>{{ $module_category_data['taxonomy_code_label'] ?? __('category.code') }}</th>
                         @endif
                         <th>@trans( 'lang_v1.description' )</th>
                         <th>@trans( 'account' )</th>
                         <th>@trans( 'messages.action' )</th>
                     </tr>
                 </thead>
             </table>
         </div>
     </div>

     <div class="modal fade category_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
     </div>

 </section>
 <!-- /.content -->
 @includeIf('taxonomy.taxonomies_js')

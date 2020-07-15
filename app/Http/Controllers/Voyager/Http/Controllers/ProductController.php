<?php

namespace App\Http\Controllers\Voyager\Http\Controllers;

use TCG\Voyager\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;



use Validator;
use Response;
use Redirect;
use Illuminate\Support\Facades\Input;
use RealRashid\SweetAlert\Facades\Alert;
use Schema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;
use App\Product;
use App\User;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;

use TCG\Voyager\Models\Category;
use File;

use App\Imports\ProductImport;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Maatwebsite\Excel\Facades\Excel;
use app\Scopes\DinamicSearchScope;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

        use BreadRelationshipParser;
        protected $connection = 'sqlPremium';
        protected $table = 'MA_CLIENTES';

        //***************************************
        //               ____
        //              |  _ \
        //              | |_) |
        //              |  _ <
        //              | |_) |
        //              |____/
        //
        //      Browse our Data Type (B)READ
        //
        //****************************************

        public function index(Request $request)
        {
            ////////base de datos

           // $sqlsrv = DB::connection('sqlPremium')->get();

            
            //dd($sqlSelect);
            // GET THE SLUG, ex. 'posts', 'pages', etc.
            $slug = $this->getSlug($request);

            // GET THE DataType based on the slug
            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Check permission
            $this->authorize('browse', app($dataType->model_name));

            $getter = $dataType->server_side ? 'paginate' : 'get';

            $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
            $searchable = $dataType->server_side ? array_keys(SchemaManager::describeTable(app($dataType->model_name)->getTable())->toArray()) : '';
            $orderBy = $request->get('order_by', $dataType->order_column);
            $sortOrder = $request->get('sort_order', null);
            $orderColumn = []; 
             if ($orderBy) {
                $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + 1;
                $orderColumn = [[$index, 'desc']];
                if (!$sortOrder && isset($dataType->order_direction)) {
                    $sortOrder = $dataType->order_direction;
                    $orderColumn = [[$index, $dataType->order_direction]];
                } else {
                    $orderColumn = [[$index, 'desc']];
                }
            }

            // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
            if (strlen($dataType->model_name) != 0) {
                $model = app($dataType->model_name);
                $query = $model::select('*');

                // If a column has a relationship associated with it, we do not want to show that field
                $this->removeRelationshipField($dataType, 'browse');

                if ($search->value && $search->key && $search->filter) {
                    $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                    $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';
                    $query->where($search->key, $search_filter, $search_value);
                }

                if ($orderBy && in_array($orderBy, $dataType->fields())) {
                    $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                    $dataTypeContent = call_user_func([
                        $query->orderBy($orderBy, $querySortOrder),
                        $getter,
                    ]);
                } elseif ($model->timestamps) {
                    $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
                } else {
                    $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
                }

                // Replace relationships' keys for labels and create READ links if a slug is provided.
                $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
            } else {
                // If Model doesn't exist, get data from table name
                $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
                $model = false;
            }

            // Check if BREAD is Translatable
            if (($isModelTranslatable = is_bread_translatable($model))) {
                $dataTypeContent->load('translations');
            }

            // Check if server side pagination is enabled
            $isServerSide = isset($dataType->server_side) && $dataType->server_side;

            // Check if a default search key is set
            $defaultSearchKey = isset($dataType->default_search_key) ? $dataType->default_search_key : null;


            ///// probando

                             //(n_activo = 1) AND (n_precio1 > 0) AND (c_departamento = 'cht' OR
                             // c_departamento = 'CAR')

                              /*consultas suaves*/
         /*$Products = DB::connection('sqlPremium')
                              ->table('MA_PRODUCTOS')
                              ->where('n_activo',1)->where('n_precio1','>',0)->take(20)->get();*/
                              $Products = DB::connection('sqlPremium')
                              ->table('MA_PRODUCTOS')
                              ->where('n_activo',1)
                              ->where('n_precio1','>',0)
                              ->where('c_departamento','cht')
                              ->orwhere('c_departamento','CAR')
                              ->join('MA_CODIGOS','MA_PRODUCTOS.C_CODIGO','=','MA_CODIGOS.c_codigo')
                              ->get();
         
        
        
      /*  $Products = DB::connection('sqlPremium')
                              ->table('MA_CODIGOS')->first();
         dd($Products);

            $Productsprueba = DB::connection('sqlPremium')
                              ->table('MA_PRODUCTOS')
                              ->where('n_activo',1)->where('n_precio1','>',0)
                               ->where('c_departamento','cht')->orwhere('c_departamento','car')->first();
            dd($Productsprueba);*/
          
            
            $users = User::all();
           // $user = Auth::user();
         //   dd($user->hasPermission('browse_admin'));
            $view = 'products.index';

            if (view()->exists("products.index")) {
                $view = "products.index";
            }

            return Voyager::view($view, compact(
                'dataType',
                'dataTypeContent',
                'isModelTranslatable',
                'search',
                'orderBy',
                'orderColumn',
                'sortOrder',
                'searchable',
                'isServerSide',
                'defaultSearchKey',
                'Products', 
                'users'
            ));

            // Check permission
            $this->authorize('browse', app($dataType->model_name));

            $getter = $dataType->server_side ? 'paginate' : 'get';

            $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
            $searchable = $dataType->server_side ? array_keys(SchemaManager::describeTable(app($dataType->model_name)->getTable())->toArray()) : '';
            $orderBy = $request->get('order_by', $dataType->order_column);
            $sortOrder = $request->get('sort_order', null);
            $orderColumn = [];
           
        }

      /** Pedidos Charcuteria */

      public function PedidosChar(Request $request)
      {

        //////// Charuteria          
         

            $Products = DB::connection('sqlPremium')
                              ->table('MA_PRODUCTOS')
                              ->where('n_activo',1)
                              ->where('n_precio1','>',0)
                              ->where('c_departamento','cht')
                              ->get();          
            
            $users = User::all();
           
            $view = 'product.productoscarcuteria';

            if (view()->exists("products.productoscarcuteria")) {
                $view = "products.productoscarcuteria";
            }

            return Voyager::view($view, compact(
                'dataType',
                'dataTypeContent',
                'isModelTranslatable',
                'search',
                'orderBy',
                'orderColumn',
                'sortOrder',
                'searchable',
                'isServerSide',
                'defaultSearchKey',
                'Products', 
                'users'
            ));          

      }


       /** Pedidos Carniceria */

       public function PedidosCar(Request $request)
       {

        //////// Carnes        

        ///// probando

        $Products = DB::connection('sqlPremium')
                          ->table('MA_PRODUCTOS')
                          ->where('n_activo',1)
                          ->where('n_precio1','>',0)
                          ->where('c_departamento','car')
                          ->get();          
        
        $users = User::all();
       
        $view = 'product.productoscarniceria';

        if (view()->exists("products.productoscarniceria")) {
            $view = "products.productoscarniceria";
        }

        return Voyager::view($view, compact(
            'dataType',            
            'Products', 
            'users'
        ));              
 
       }


        //***************************************
        //                _____
        //               |  __ \
        //               | |__) |
        //               |  _  /
        //               | | \ \
        //               |_|  \_\
        //
        //  Read an item of our Data Type B(R)EAD
        //
        //****************************************

        public function show(Request $request, $id)
        {
            $slug = $this->getSlug($request);

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            if (strlen($dataType->model_name) != 0) {
                $model = app($dataType->model_name);
                $dataTypeContent = call_user_func([$model, 'findOrFail'], $id);
            } else {
                // If Model doest exist, get data from table name
                $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'read');

            // Check permission
            $this->authorize('read', $dataTypeContent);

            // Check if BREAD is Translatable
            $isModelTranslatable = is_bread_translatable($dataTypeContent);

            $view = 'voyager::bread.read';

            if (view()->exists("voyager::$slug.read")) {
                $view = "voyager::$slug.read";
            }

            return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
        }

        //***************************************
        //                ______
        //               |  ____|
        //               | |__
        //               |  __|
        //               | |____
        //               |______|
        //
        //  Edit an item of our Data Type BR(E)AD
        //
        //****************************************

        public function edit(Request $request, $id)
        {
            $slug = $this->getSlug($request);

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            $dataTypeContent = (strlen($dataType->model_name) != 0)
                ? app($dataType->model_name)->findOrFail($id)
                : DB::table($dataType->name)->where('id', $id)->first(); // If Model doest exist, get data from table name

            foreach ($dataType->editRows as $key => $row) {
                $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'edit');

            // Check permission
            $this->authorize('edit', $dataTypeContent);

            // Check if BREAD is Translatable
            $isModelTranslatable = is_bread_translatable($dataTypeContent);

            $view = 'voyager::bread.edit-add';

            if (view()->exists("voyager::$slug.edit-add")) {
                $view = "voyager::$slug.edit-add";
            }

            return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
        }

        // POST BR(E)AD
        public function update(Request $request, $id)
        {
            $slug = $this->getSlug($request);

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Compatibility with Model binding.
            $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;

            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

            // Check permission
            $this->authorize('edit', $data);

            // Validate fields with ajax
            $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id);

            if ($val->fails()) {
                return response()->json(['errors' => $val->messages()]);
            }

            if (!$request->ajax()) {
                $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

                event(new BreadDataUpdated($dataType, $data));

                return redirect()
                    ->route("voyager.{$dataType->slug}.index")
                    ->with([
                        'message'    => __('voyager::generic.successfully_updated')." {$dataType->display_name_singular}",
                        'alert-type' => 'success',
                    ]);
            }
        }

        //***************************************
        //
        //                   /\
        //                  /  \
        //                 / /\ \
        //                / ____ \
        //               /_/    \_\
        //
        //
        // Add a new item of our Data Type BRE(A)D
        //
        //****************************************

        public function create(Request $request)
        {
            $slug = $this->getSlug($request);

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Check permission
            $this->authorize('add', app($dataType->model_name));

            $dataTypeContent = (strlen($dataType->model_name) != 0)
                                ? new $dataType->model_name()
                                : false;

            foreach ($dataType->addRows as $key => $row) {
                $dataType->addRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'add');

            // Check if BREAD is Translatable
            $isModelTranslatable = is_bread_translatable($dataTypeContent);

            $view = 'voyager::bread.edit-add';

            if (view()->exists("voyager::$slug.edit-add")) {
                $view = "voyager::$slug.edit-add";
            }

            return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
        }

        /**
         * POST BRE(A)D - Store data.
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function store(Request $request)
        {
            $slug = $this->getSlug($request);

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Check permission
            $this->authorize('add', app($dataType->model_name));

            // Validate fields with ajax
            $val = $this->validateBread($request->all(), $dataType->addRows);

            if ($val->fails()) {
                return response()->json(['errors' => $val->messages()]);
            }

            if (!$request->has('_validate')) {
                $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

                event(new BreadDataAdded($dataType, $data));

                if ($request->ajax()) {
                    return response()->json(['success' => true, 'data' => $data]);
                }

                return redirect()
                    ->route("voyager.{$dataType->slug}.index")
                    ->with([
                            'message'    => __('voyager::generic.successfully_added_new')." {$dataType->display_name_singular}",
                            'alert-type' => 'success',
                        ]);
            }
        }

        //***************************************
        //                _____
        //               |  __ \
        //               | |  | |
        //               | |  | |
        //               | |__| |
        //               |_____/
        //
        //         Delete an item BREA(D)
        //
        //****************************************

        public function destroy(Request $request, $id)
        {
            $slug = $this->getSlug($request);

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Check permission
            $this->authorize('delete', app($dataType->model_name));

            // Init array of IDs
            $ids = [];
            if (empty($id)) {
                // Bulk delete, get IDs from POST
                $ids = explode(',', $request->ids);
            } else {
                // Single item delete, get ID from URL
                $ids[] = $id;
            }
            foreach ($ids as $id) {
                $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
                $this->cleanup($dataType, $data);
            }

            $displayName = count($ids) > 1 ? $dataType->display_name_plural : $dataType->display_name_singular;

            $res = $data->destroy($ids);
            $data = $res
                ? [
                    'message'    => __('voyager::generic.successfully_deleted')." {$displayName}",
                    'alert-type' => 'success',
                ]
                : [
                    'message'    => __('voyager::generic.error_deleting')." {$displayName}",
                    'alert-type' => 'error',
                ];

            if ($res) {
                event(new BreadDataDeleted($dataType, $data));
            }

            return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
        }

        /**
         * Remove translations, images and files related to a BREAD item.
         *
         * @param \Illuminate\Database\Eloquent\Model $dataType
         * @param \Illuminate\Database\Eloquent\Model $data
         *
         * @return void
         */
        protected function cleanup($dataType, $data)
        {
            // Delete Translations, if present
            if (is_bread_translatable($data)) {
                $data->deleteAttributeTranslations($data->getTranslatableAttributes());
            }

            // Delete Images
            $this->deleteBreadImages($data, $dataType->deleteRows->where('type', 'image'));

            // Delete Files
            foreach ($dataType->deleteRows->where('type', 'file') as $row) {
                if (isset($data->{$row->field})) {
                    foreach (json_decode($data->{$row->field}) as $file) {
                        $this->deleteFileIfExists($file->download_link);
                    }
                }
            }
        }

        /**
         * Delete all images related to a BREAD item.
         *
         * @param \Illuminate\Database\Eloquent\Model $data
         * @param \Illuminate\Database\Eloquent\Model $rows
         *
         * @return void
         */
        public function deleteBreadImages($data, $rows)
        {
            foreach ($rows as $row) {
                if ($data->{$row->field} != config('voyager.user.default_avatar')) {
                    $this->deleteFileIfExists($data->{$row->field});
                }

                if (isset($row->details->thumbnails)) {
                    foreach ($row->details->thumbnails as $thumbnail) {
                        $ext = explode('.', $data->{$row->field});
                        $extension = '.'.$ext[count($ext) - 1];

                        $path = str_replace($extension, '', $data->{$row->field});

                        $thumb_name = $thumbnail->name;

                        $this->deleteFileIfExists($path.'-'.$thumb_name.$extension);
                    }
                }
            }

            if ($rows->count() > 0) {
                event(new BreadImagesDeleted($data, $rows));
            }
        }

        /**
         * Order BREAD items.
         *
         * @param string $table
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function order(Request $request)
        {
            $slug = $this->getSlug($request);

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Check permission
            $this->authorize('edit', app($dataType->model_name));

            if (!isset($dataType->order_column) || !isset($dataType->order_display_column)) {
                return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                    'message'    => __('voyager::bread.ordering_not_set'),
                    'alert-type' => 'error',
                ]);
            }

            $model = app($dataType->model_name);
            $results = $model->orderBy($dataType->order_column, $dataType->order_direction)->get();

            $display_column = $dataType->order_display_column;

            $dataRow = Voyager::model('DataRow')->whereDataTypeId($dataType->id)->whereField($display_column)->first();

            $view = 'voyager::bread.order';

            if (view()->exists("voyager::$slug.order")) {
                $view = "voyager::$slug.order";
            }

            return Voyager::view($view, compact(
                'dataType',
                'display_column',
                'dataRow',
                'results'
            ));
        }

        public function update_order(Request $request)
        {
            $slug = $this->getSlug($request);

            $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

            // Check permission
            $this->authorize('edit', app($dataType->model_name));

            $model = app($dataType->model_name);

            $order = json_decode($request->input('order'));
            $column = $dataType->order_column;
            foreach ($order as $key => $item) {
                $i = $model->findOrFail($item->id);
                $i->$column = ($key + 1);
                $i->save();
            }
        }


        public function editItems(Request $request) {


            $id=$request->get('id');
            $file = $request->file('pictureinput');



                $name = str_random(30).'-'.$file->getClientOriginalName();
                $path=public_path().'/img/product/';
                $file->move($path,$name);
                $Products=Product::find($id);

                if($Products->image){
                  $imaEliminar=public_path().$Products->image;

                    File::delete($Products->image);

                    unlink($imaEliminar);

                }
 
            $Products->fill([
                 'private' => $request->get('private'),
                 'outOfStock' => $request->get('outOfStock'),
                 'picture' => $request->get('pictureinput'),
                 'keywords' => $request->get('keywords'),
                 'brand' => $request->get('brand'),
                 'store' => $request->get('store'),
                 'conditionRefund' => $request->get('conditionRefund'),
                 'info' => $request->get('info'),
                 'privatInfo' => $request->get('privatInfo'),
                 'maxOrdersPerDay' => $request->get('maxOrdersPerDay'),
                 'soldToday' => $request->get('soldToday'),
                 'maxOrdersPerWeek' => $request->get('maxOrdersPerWeek'),
                 'soldWeek' => $request->get('soldWeek'),
                 'maxOrdersTotal' => $request->get('maxOrdersTotal'),
                 'soldTotal' => $request->get('soldTotal'),
                 'commission' => $request->get('commission'),
                 'user_id' => $request->get('seller'),
                 'asin' => $request->get('asin'),
                 'coverFees' => $request->get('coverFees'),
                 'price' => $request->get('price'),
                 'link' => $request->get('link'),
                 'soldTotal' => $request->get('soldTotal'),
                  'image' => '/img/product/'.$name,
                  'product_states_id' => 1,
               //  'status' => $request->get('status'),
              ]);

             $Products->save();
             $Products = Product::all();
             $users = User::all();

           // dd($Category[0]->id);

             return  view('products.index', compact('Products','users'));

         }


         public function ProductUploadPost(Request $request)

         {


         //   dd($request);
            $file = $request->file('image');
            $name = str_random(30).'-'.$file->getClientOriginalName();
            $path=public_path().'/img/product/';
            $file->move($path,$name);
            // dd($path);

            $Prod=Product::create([
                 'code' => $request->get('code'),
                 'name' => $request->get('name'),
                 'model' => $request->get('model'),
                 'maker' => $request->get('maker'),
                 'category_id' => $request->get('category'),
                 'description' => $request->get('description'),
                 'presentation' => $request->get('presentation'),
                 'image' => '/img/product/'.$name,
                 'status' => $request->get('status'),
              ]);

             $Prod->save();
              $Products = Product::all();

              $Categories = Category::all();
              $Makers = Maker::all();

           // dd($Category[0]->id);

             return Voyager::view('products.index', compact('Products','Categories','Makers'));

         }

         public function addItem(Request $request) {

            //dd($request);
          //  $file = $request->file('pictureinput');
         //   $name = str_random(30).'-'.$file->getClientOriginalName();
          //  $path=public_path().'/img/product/';
          //  $file->move($path,$name);
            // dd($path);


            $Prod=Product::create([

                'private' => true,
                'available' => false,
                'picture' => $request->get('pictureinput'),
                'keywords' => $request->get('keywords'),
                'brand' => $request->get('brand'),
                'store' => $request->get('store'),
                'asin' => $request->get('asin'),
                'cover_fees' => false,
               // 'cover_fees' => $request->get('coverFees'),
                'price' => $request->get('price'),
                'link' => $request->get('link'),
                'condition_refund' => $request->get('conditionRefund'),
                'info' => $request->get('info'),
                'maxOrdersPerDay' => $request->get('maxOrdersPerDay'),
                'soldTotal' => $request->get('soldTotal'),
                'ordersRemainingToday' => 0,
                'maxOrdersPerWeek' => $request->get('maxOrdersPerWeek'),
                'soldWeek' => $request->get('soldWeek'),
                'ordersRemainingWeek' => 0,
                'maxOrdersTotal' => $request->get('maxOrdersTotal'),
                'soldToday' => $request->get('soldToday'),
                'ordersRemainingTotal' => 0,
                'commission' => $request->get('commission'),
                'commission_agent' => 0,
                'seller_id'  => $request->get('seller'),
                'admin_id'  => null,
                //'model' => '',
                'name' => '',
                'description' => '',
                'outOfStock' => false,
                'privat_info' => '',
                'product_states_id' => 1,
              ]);

             $Prod->save();

             $Products = Product::all();
             $users = User::all();

           // dd($Category[0]->id);

             return  view('products.index', compact('Products','users'));


         }


         public function addItem2(Request $request) {

            //dd($request);
           // $file = $request->file('pictureinput');
           // $name = str_random(30).'-'.$file->getClientOriginalName();
           // $path=public_path().'/img/product/';
            //$file->move($path,$name);
            // dd($path);

            $Prod=Product::create([
                'private' => true,
                'available' => true,
                'picture'  => 'picture',
                'keywords' => 'keywords',
                'brand' => 1,
                'store' => 1,
                'asin' => 1,
                'cover_fees' => true,
                'price' => '12.5',
                'link' => 'link',
                'condition_refund' => 'condition_refund',
                'info' => 'info',
                'maxOrdersPerDay' => 0,
                'soldTotal' => 0,

                'ordersRemainingToday' => 0,
                'maxOrdersPerWeek' => 0,
                'soldWeek' => 0,

                'ordersRemainingWeek' => 0,
                'maxOrdersTotal' => 0,
                'soldToday' => 0,

                'ordersRemainingTotal' => 0,
                'commission' => 0,
                'commission_agent' => 0,

                'seller_id'  => null,
                'admin_id'  => 1,
                //'model' => '',
                'name' => '',
                'description' => '',
                'outOfStock' => false,
                'privat_info' => '',
                'product_states_id' => 1,


              ]);

             $Prod->save();

             $Products = Product::all();
             $users = User::all();

           // dd($Category[0]->id);

             return  view('products.index', compact('Products','users'));


         }






         public function destroycampo(Request $request)
         {

           //  dd($request->id);


             if($request->ajax()){
                     $id=$request->post('id');

                            if($id=='null'){
                                $Products = Product::all();
                                $users = User::all();

                                  return view('products.index', compact('Products','users'));

                                            }else{


                                                  // $prod=Product::find($id);
                                                  // $imaEliminar=public_path().$prod->image;
                                                   //File::delete($prod->image);
                                                  // unlink($imaEliminar);

                                                  $_token=$request->get('_token');
                                                   $Products=Product::find($id);
                                                   if($Products != null){
                                                   $Products->delete();

                                                   $Products = Product::all();
                                                   $users = User::all();

                                                     return view('products.index', compact('Products','users'));
                                                    }else{

                                                      return Alert::success('Success','Error')->autoClose(1800);
                                                    }

                                            }
                                 }
         }


          public function destroycampoprueba($id)
         {

            // dd($id);


             if($id){


                            if($id=='null'){
                                $Products = Product::all();
                                $users = User::all();

                                  return Voyager::view('products.index', compact('Products','users'));

                                            }else{


                                                   //$prod=Product::find($id);

                                                  // $imaEliminar=public_path().$prod->image;
                                                  // File::delete($prod->image);
                                                  // unlink($imaEliminar);

                                                //  $_token=$request->get('_token');
                                                   $Products=Product::find($id);
                                                   dd($Products);
                                                   if($Products != null){
                                                   $Products->delete();

                                                   $Products = Product::all();
                                                   $users = User::all();
                                                   dd($Products);
                                                     }else{

                                                      dd('error');
                                                    }

                                            }
                                 }
         }



         public function import(Request $request){

           $BrowseFile = $request->file('BrowseFile');

           $name = $_FILES['BrowseFile']['name'];
           \Storage::disk('local')->put($name, \File::get($BrowseFile));

           $public_path = public_path('storage');

              // if(file_exists($path)){
                   Excel::import(new ProductImport,$BrowseFile);
                   return back()->with('message','completa la importacion');
               //  }

         }


         public function import2(Request $request){
                $path = $request->get('BrowseFile');

                $name = 'Products_Availables.xlsx';
            \Storage::disk('local')->put($name, \File::get($path));

            $public_path = public_path('storage');

               // if(file_exists($path)){
                    Excel::import(new ProductImport,$path);
                //    return back()->with('message','completa la importacion');
                //  }
          }

          public function importFiles(Request $request){

            $BrowseFile = $request->file('BrowseFile');
            $name = $_FILES['BrowseFile']['name'];
            \Storage::disk('local')->put($name, \File::get($BrowseFile));

            $public_path = public_path('storage');


             // if(file_exists($BrowseFile)){
                Excel::import(new ProductImport,$BrowseFile);
                //   return back()->with('message','completa la importacion');
                // }


                   $Products = Product::all();
                    $users = User::all();

                  // dd($Category[0]->id);

                    return  view('products.index', compact('Products','users'));
          }
          ///contruct Dinamic condition

          public function contructCondicion($contrucccionSelect,$value){
              //is equal to
                          if($value->value=="="){

                              $contrucccionSelect.="'".$value->value."',";
                          }else{
                              //not equal to
                              if($value->value=="!="){

                                  $contrucccionSelect.="'".$value->value."',";
                              }else{
                                 ///is greater than
                                 if($value->value==">"){

                                      $contrucccionSelect.="'".$value->value."',";
                                  }else{
                                     ///is greater than equak
                                     if($value->value==">="){

                                          $contrucccionSelect.="'".$value->value."',";
                                      }else{
                                          ///is less than
                                          if($value->value=="<"){

                                                  $contrucccionSelect.="'".$value->value."',";
                                              }else{
                                                  // is less than equal
                                                  if($value->value=="<="){

                                                      $contrucccionSelect.="'".$value->value."',";
                                                  }else{
                                                      $contrucccionSelect.=$value->value."";
                                                  }
                                              }
                                      }
                                  }
                              }
                          }
                          return $contrucccionSelect;
          }

          ///contruct Dinamic consult

          public function contructConsult2(Request $request){

            $ProducQuery = Product::query()->get();
           // dd($ProducQuery);

            return $this->contructConsult($request);

          }

          ///contruct Dinamic consult

          public function contructConsult(Request $request){
           $id = $request->get("id");
          // printf($id);

           $contrucccionSelect = '';
           $bande=true;
           $bandeAnd=true;
           $bandeOr=false;
            $parametros=json_decode($request->get('jsonParametros'));

            $contrucccionSelect= "where(";
             foreach($parametros as $key => $value){
               // printf($value->value);
            //   if($id>1){
                        if($value->value=="AND"){
                            $contrucccionSelect.=")->where(";
                            $bande=true;
                            }else{
                                if($value->value=="OR"){
                                    $contrucccionSelect.=")->orwhere(";
                                    $bande=true;
                                }else{
                                    if($bande==true){
                                        $contrucccionSelect.="'".$value->value."',";
                                        $bande=false;
                                    }else{
                                        $contrucccionSelect .= $this->contructCondicion($contrucccionSelect,$value);
                                    }
                                }
                            }
           //    }else{
                //       $contrucccionSelect .= $this->contructCondicion($contrucccionSelect,$value);
                   // }
             }
             $contrucccionSelect.=")";
             printf($contrucccionSelect);
          //  $productResul = Product::$contrucccionSelect->get();
            return $contrucccionSelect;

          }

          ///Search Dinamic

          public function Search(Request $request){
               return $this->contructConsult($request);
              // $query = DB::table('products')->whereRaw('');
          }

          public function newProducts(Request $request){


            $Products = DB::connection('sqlPremium')
                              ->table('MA_PRODUCTOS')
                              ->where('n_activo',1)
                              ->where('n_precio1','>',0)
                              ->where('c_departamento','cht')
                              ->orwhere('c_departamento','CAR')
                              ->get();
             
            //dd($Products);
            $users = User::all();
           // $user = Auth::user();
         //   dd($user->hasPermission('browse_admin'));
            $view = 'products.New.NewProduct';

            if (view()->exists("products.New.NewProduct")) {
                $view = "products.New.NewProduct";
            }

            return Voyager::view($view, compact(
                'Products',
                'users'
            ));

          }

          public function Approve(Request $request){

           // $user = Auth::user();
           // $carbon = new \Carbon\Carbon();
           // $data = $carbon->now();

            $id=$request->get('id');
           // dd($id);
            $Products=Product::find($id);
            $Products->product_states_id=2;
          //  $Products->updated_at = $data->toDateTimeString();
          //  $Products->modified_by = $user->id;
            $Products->save();
            // $Products = Product::all();

            return $Products;

          }

    }


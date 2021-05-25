@extends('layouts.master')
@section('content')

   {{-- {{ dd(session()->get('cart')) }} --}}
   
   <div class="parent-loader">
      
   </div>
   <div class="container">
      <div class="row">
         <div class="col-12 col-sm-12 col-md-8">
            <table class="table">
               <thead>
                  <tr>
                     <th>*</th>
                     <th>Item</th>
                     <th>Name</th>
                     <th>Price</th>
                     <th>Quantity</th>
                     <th>Total</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody id="data-each">
                  {{-- @foreach($carts as $data) --}}
                  {{-- <tr> --}}
                     {{-- <td id="id" data-id="{{ $data['id'] }}">{{ $id++ }}</td>
                     <td><img id="image" src="{{ $data['image'] }}" alt="" width="100px" height="100px"></td>
                     <td id="name">{{ $data['name'] }}</td>
                     <td id="price">{{ $data['price'] }}</td>
                     <td id="quantity">{{ $data['quantity'] }}</td>
                     <td id="total">{{ $data['price'] * $data['quantity'] }}</td> --}}
                     {{-- <td>
                        <a id="delete">Delete</a>
                     </td> --}}
                  {{-- </tr> --}}
                  {{-- @endforeach --}}
                  
               </tbody>
            </table>
            <span class="float-right" id="total-all"></span>
         </div>

         <div class="col-12 col-sm-12 col-md-4">
            <div class="card">
               <div class="card-header text-center">
                  Total
               </div>
               <div class="card-body text-center">
                  <table class="table">
                     <thead>
                        <tr>
                           <th>Subtotal:</th>
                           <td class="total"></td>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <th>Total:</th>
                           <td class="total"></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer text-center">
                  <a style="text-decoration: underline;" href="{{ route('cart.showcheckout') }}">Checkout</a>
               </div>
            </div>
         </div>
         <a href="{{ route('product.show') }}"><--- Tiếp tục mua hàng</a>
         
        
      </div>
   </div>

@endsection

@section('script')
   <script>
         function xuong(id) {
            if(+$(`#inputQuan-${id}`).val() <= 1){
               toastr('Warning','Sản phẩm phải lớn hơn 0','warning');
            }else{
               var xuong = +$(`#inputQuan-${id}`).val()-1;
               $(`#inputQuan-${id}`).val(xuong);
               btnUpdate(id);
            }
         }
         function len(id) {
            var len = +$(`#inputQuan-${id}`).val()+1;
            $(`#inputQuan-${id}`).val(len);
            btnUpdate(id);
         }

         function actionDelete(id){
            $.ajax({
               url: '/cart/delete/'+id,
               type: 'GET',
               success: function(data){
                  loadData();
               }
            });
         }
         

         function btnUpdate(id){
            $id = $(`#inputQuan-${id}`);
            $quantity = $(`#inputQuan-${id}`).val();
            $.ajax({
               url: '/cart/update',
               type: 'GET',
               data: {idPro:id, quantityy:$quantity},
               success: function(data){
                  $.each(data.cart, function(i, v){
                     if(`#total-${i}`){
                        $total = v.price * v.quantity;
                     }
                     $(`#total-${i}`).html($total);
                  })
                  loadData();
               },
               error: function(err){
                  console.log(err);
               }
            })
         }

         function loadData(){
            $idUp = 1;
            $.ajax({
               url: '/data-cart',
               type: 'GET',
               beforeSend: function(){
                  $('.parent-loader').append('<div class="loader"></div>');
               },
               success: function(data){
                  $html = '';
                  // console.log(data);
                  $.each(data.cart, function(i, v){
                     $html += `<tr>
                                 <td id="id">`+ $idUp++ +`</td>
                                 <td><img id="image" src="`+v.image+`" alt="" width="100px" height="100px"></td>
                                 <td>`+v.name+`</td>
                                 <td>`+v.price+`</td>
                                 <td>
                                    <div class="buttons_added">
                                       <input class="minus is-form" onclick="xuong(`+v.id+`)" type="button" value="-">
                                       <input aria-label="quantity" id="inputQuan-`+v.id+`" class="input-qty" max="10" min="1" onclick="btnUpdate(`+v.id+`)" name="quantity" disabled type="number" value="`+v.quantity+`">
                                       <input class="plus is-form" onclick="len(`+v.id+`)" type="button" value="+">
                                    </div>
                                 </td>
                                 <td id="total-`+v.id+`">`+v.price * v.quantity+`</td>
                                 <td><a href='#' onclick="actionDelete(`+v.id+`)">Delete</a></td>
                              </tr>`;
                  });
                  // $('#total-all').text('Tổng giá các sản phẩm: '+data.total);
                  $('.total').text(data.total);
                  $('#data-each').html($html);
                  $('.loader').remove();
               },
               error: function(error){
                  console.log(error);
               }
            })
         }
         loadData();

         function toastr(title,mess,icon){
            $.toast({
                heading: title,
                text: mess,
                icon: icon,
                loader: true,
                position: 'bottom-right',
                loaderBg: '#9EC600'
            })
        }
   </script>
@endsection
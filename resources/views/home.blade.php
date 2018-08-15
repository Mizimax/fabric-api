@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 20px">
  <div class="card">
  <div class="row">
    <div class="col s12" style="padding: 0">
      <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#page1">Welcome page</a></li>
        <li class="tab col s3"><a href="#page2">Menu Page</a></li>
        <li class="tab col s3"><a href="#page3">Product</a></li>
        <li class="tab col s3"><a href="#page4">House</a></li>
      </ul>
    </div>
    <div id="page1" class="col s12 tabshow" align="center">
      <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
          @csrf 
          <div class="group">
            Loading...
          </div>
      </form>
    </div>
    <div id="page2" class="col s12 tabshow" align="center"> 
      <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
          @csrf 
          <div class="group">
            Loading...
          </div>
          
      </form>
    </div>
    <div id="page3" class="col s12 tabshow" align="center">
      Loading...
    </div>
    <div id="page4" class="col s12 tabshow" align="center">
      Loading...
    </div>
  </div>
  </div>
</div>
@endsection
@section('script')
<script>
  loadWelcome();
  loadType();
  loadProduct();
  loadHouse();
  $(document).ready(function(){
    var instance = M.Tabs.init($('.tabs')[0]);
  });

  var addProduct = (function(index) {
    if(typeof index === "undefined") {
      index = 999;
      products[index] = {
        image_url: [],
        product_name: '',
        product_detail: '',
        product_color: '',
        tag_name: ''
      }
    }
    var text = `
        <form method="POST" action="">
          @csrf
          <div class="input-field">
            <img src="" width="100" id="bgshow">
            <input name="product_image[]" type="file">
            <button type="submit" class="btn btn-primary">
                  เพิ่มรูป
            </button>
          </div> 
          <div class="input-field">
            <textarea id="product_name" name="product_name" class="materialize-textarea"></textarea>
            <label for="">Product name</label>
          </div>
          <div class="input-field">
            <textarea id="product_detail" name="product_detail" class="materialize-textarea"></textarea>
            <label for="">Product detail</label>
          </div>
          <div class="input-field">
            <textarea id="product_color" name="product_color" class="materialize-textarea"></textarea>
            <label for="">Product color</label>
          </div>
          <div class="input-field">
            <select>
              <option value="" disabled selected>เลือกบ้าน</option>
              ${
                houses.map(ele=>`<option value="${ele.house_id}">${ele.house_name}</option>`)
              }
            </select>
            <label>House</label>
          </div>
          <label class="check">
            <input type="checkbox" />
            <span>Limited</span>
          </label>
          <label class="check">
            <input type="checkbox" />
            <span>Natural</span>
          </label>
          <label class="check">
            <input type="checkbox" />
            <span>Handcraft</span>
          </label>
          <div class="form-group row mb-0" style="margin-top: 20px">
              <div class="col-md-8 offset-md-4">
                <button type="button" onclick="backProduct()" class="btn red" style="margin-right: 20px"><
                    ย้อนกลับ
                </button>
                <button type="submit" class="btn btn-primary">
                    บันทึก
                </button>

              </div>
          </div>
        </form>
    `;
    window.products = $('#page3').html();
    $('#page3').html(text)
    M.FormSelect.init($('select')[0]);
  })

  var addHouse = (function(index) {
    if(typeof index === "undefined") {
      index = 999;
      houses[index] = {
        house_name: '',
        house_detail: '',
        house_province: '',
        house_video: '',
        house_address_url: '',
        house_phone: '',
        house_phone_home: ''
      }
    }
    var text = `
        <form method="POST" action="">
          @csrf
          <div class="input-field">
            <img src="${houses[index].house_image}" width="100" id="bgshow">
            <input id="house_image" name="house_image" type="file">
          </div> 
          <div class="input-field">
            <textarea id="house_name" name="house_name" class="materialize-textarea">${houses[index].house_name}</textarea>
            <label for="">ชื่อบ้าน</label>
          </div>
          <div class="input-field">
            <textarea id="house_detail" name="house_detail" class="materialize-textarea">${houses[index].house_detail}</textarea>
            <label for="">รายละเอียด</label>
          </div>
          <div class="input-field">
            <textarea id="house_province" name="house_province" class="materialize-textarea">${houses[index].house_province}</textarea>
            <label for="">จังหวัด</label>
          </div>
          <div class="input-field">
            <textarea id="house_video" name="house_video" class="materialize-textarea">${houses[index].house_video}</textarea>
            <label for="">วิดีโอไว้แสดง (ลิงค์ .mp4)</label>
          </div>
          <div class="input-field">
            <textarea id="house_address_url" name="house_address_url" class="materialize-textarea">${houses[index].house_address_url}</textarea>
            <label for="">ที่อยู่ (ลิงค์ google map)</label>
          </div>
          <div class="input-field">
            <textarea id="house_phone" name="house_phone" class="materialize-textarea">${houses[index].house_phone}</textarea>
            <label for="">เบอร์โทรศัพท์</label>
          </div>
          <div class="input-field">
            <textarea id="house_phone_home" name="house_phone_home" class="materialize-textarea">${houses[index].house_phone_home}</textarea>
            <label for="">เบอร์ office</label>
          </div>
          <div class="form-group row mb-0" style="margin-top: 20px">
              <div class="col-md-8 offset-md-4">
                <button type="button" onclick="backHouse()" class="btn red" style="margin-right: 20px"><
                    ย้อนกลับ
                </button>
                <button type="submit" class="btn btn-primary">
                    บันทึก
                </button>

              </div>
          </div>
        </form>
    `;
    window.products = $('#page4').html();
    $('#page4').html(text)
    M.FormSelect.init($('select')[0]);
  })

  var backProduct = (function() {
    $('#page3').html(window.products);
  })

  var backHouse = (function() {
    $('#page4').html(window.products);
  })
</script>
@endsection

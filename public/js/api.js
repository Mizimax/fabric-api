var houses = [];
var houses_length = 0;
var loadWelcome = function() {
    $.ajax({
        url: "/api/v1/image/home",
        method: "GET",
        success: function(res) {
            var result = {};
            res.data.forEach(ele => {
                result[ele.name] = ele.data;
            });
            var text = `
            <div class="input-field">
              <img src="${result["HOME_BG_IMAGE"]}" width="100" id="bgshow">
              <input id="bg" name="bg" type="file">
            </div>
            <div class="input-field">
              <img src="${result["HOME_IMAGE"]}" width="100" id="logoshow">
              <input id="logo" name="logo" type="file">
            </div>
            <div class="input-field">
              <input type="text" id="welcome" name="welcome" class="materialize-textarea" value="${
                  result["HOME_WELCOME"]
              }">
              
            </div>
            <div class="input-field">
              <input type="text" id="desc" name="desc" class="materialize-textarea" value="${
                  result["HOME_TEXT"]
              }">
              
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        บันทึก
                    </button>

                </div>
            </div>  
            `;
            $("#page1 .group").html(text);
        }
    });
};

var loadType = function() {
    $.ajax({
        url: "/api/v1/image/type",
        method: "GET",
        success: function(res) {
            var result = {};
            res.data.forEach(ele => {
                result[ele.name] = ele.data;
            });
            houses_length = res.data.length;
            var text = `
              <div class="input-field">
                <img src="${result["TYPE_IMAGE_1"]}" width="100" id="bgshow">
                <input id="cotton" name="cotton" type="file">
              </div> 
              <div class="input-field">
                <textarea id="cotton_text" name="cotton_text" class="materialize-textarea">${
                    result["TYPE_TEXT_1"]
                }</textarea>
              </div>
              
              <div class="input-field">
                <img src="${result["TYPE_IMAGE_2"]}" width="100" id="logoshow">
                <input id="silk" name="silk" type="file">
              </div>
              <div class="input-field">
                <textarea id="silk_text" name="silk_text" class="materialize-textarea">${
                    result["TYPE_TEXT_2"]
                }</textarea>
              </div>

              <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                          บันทึก
                      </button>

                  </div>
              </div>
            `;
            $("#page2 .group").html(text);
        }
    });
};

var loadProduct = function() {
    $.ajax({
        url: "/api/v1/products/cotton",
        method: "GET",
        success: function(res) {
            var result = [];
            var i = 0;
            for (var obj in res.data) {
                for (var ob in res.data[obj]) {
                    result[i] = res.data[obj][ob];
                    i++;
                }
            }
            var text = `
            <h5>Cotton</h5>
            <div class="cotton">
              <div class="products">
                ${result.map(
                    ele =>
                        `
                  <div class="product pointer">
                    <div class="card">
                      <div class="card-image">
                        <img src="${ele.image_url[0]}" width="50">
                        <span class="card-title">${ele.product_name}</span>
                      </div>
                    </div>
                  </div>
                  `
                )}
                
              </div>
              
            </div>
            
            <br>
            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary" onclick="addProduct()">
                        เพิ่ม Product
                    </button>

                </div>
            </div>
          `;

            $("#page3").html(text);
            $.ajax({
                url: "/api/v1/products/silk",
                method: "GET",
                success: function(ress) {
                    var result = [];
                    var i = 0;
                    for (var obj in ress.data) {
                        for (var ob in ress.data[obj]) {
                            result[i] = ress.data[obj][ob];
                            i++;
                        }
                    }
                    var text = `
                <h5>Silk</h5>
                <div class="silk">
                  <div class="products">
                  ${result.map(
                      ele =>
                          `
                    <div class="product pointer">
                      <div class="card">
                        <div class="card-image">
                          <img src="${ele.image_url[0]}" width="50">
                          <span class="card-title">${ele.product_name}</span>
                        </div>
                      </div>
                    </div>
                    `
                  )}
                  
                  </div>
                </div>
                `;

                    $(text).insertAfter(".cotton");
                }
            });
        }
    });
};

var loadHouse = function() {
    $.ajax({
        url: "/api/v1/houses",
        method: "GET",
        success: function(res) {
            var text = `
              <h5>House</h5>
              <div class="houses">
                <div class="products" id="house">
            `;
            res.data.forEach((ele, index) => {
                houses[index] = ele;

                text += `
              <div class="product pointer" onclick="addHouse(${index})">
                <div class="card">
                  <div class="card-image">
                    <img src="${ele.house_image}" width="50">
                    <span class="card-title">${ele.house_name}</span>
                  </div>
                </div>
              </div>
              `;
            });
            text += `
              </div>   
            </div>
            <br>
            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary" onclick="addHouse()">
                        เพิ่ม House
                    </button>
      
                </div>
            </div>
            `;

            $("#page4").html(text);
        }
    });
};

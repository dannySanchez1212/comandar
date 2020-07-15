@php
  $user = Auth::user();
 // dd($user);
@endphp


<div id="searchProduct" class="col-sm-15" style="display:none;padding-left: 4%;border: solid;padding-right: 1%;">
    <div style="display: flex;justify-content: space-between;">
        <label for="">Search Options</label>
        <a class="bb-link" href="javaScript:search()">X</a>
    </div>
  <div class="bb-gridview-advsearch-container" style="">
     <form id="searchDinamic">
                      <div id="add_itens_search">

                          <div class="col-md-12">
                              <div class="col-md-2" style="padding: unset;">
                                <select id="bdSelect_0" name="bb-select-db-logicaloper_1" class="bb-advsearch-item-field bb-advsearch-item-field_1">
                                    <option value="id">ID ARTICLE</option>
                                    <option value="country">COUNTRY</option>
                                    <option value="picture">PICTURE</option>
                                    <option value="keywords">KEYWORDS</option>
                                    <option value="brand">BRAND</option>
                                    <option value="store">STORE</option>
                                    <option value="asin">ASIN</option>
                                    <option value="coverFees">COVER FEES</option>
                                    <option value="price">PRICE</option>
                                    <option value="conditionRefund">CONDITION REFUND</option>
                                    <option value="link">LINK</option>
                                    <option value="info">INFO</option>
                                    <option value="commissionAgent">COMMISSION AGENT</option>
                                </select>
                              </div>

                              <div class="col-md-2" style="padding: unset;">
                                <select id="dbStatus_0" name="bb-select-status-logicaloper_1" class="bb-advsearch-item-oper bb-advsearch-item-oper_1">
                                    <option value="=">is equal to</option>
                                    <option value="!=">not equal to</option>
                                    <option value="contains">contains</option>
                                    <option value="notcontains">not contains</option>
                                    <option value="start">starts with</option>
                                    <option value="end">ends with</option>
                                    <option value="empty">is empty</option>
                                    <option value="notempty">is not empty</option>
                                    <option value=">">is greater than</option>
                                    <option value=">=">is greater than equal</option>
                                    <option value="<">is less than</option>
                                    <option value="<=">is less than equal</option>
                                </select>
                              </div>
                              <div class="col-md-2" style="padding: unset;">
                                <input id="dbSearch_0" name="bb-select-dinamic-logicaloper_1"   class="bb-advsearch-item-oper bb-advsearch-item-oper_1" type="text" autocomplete="off" class="bb-advsearch-item-val_1">
                              </div>
                              <div class="col-md-1" style="padding: unset;">
                                <input id="add_0"   type="image" src="https://basebear.com/images/datagrid/add.png" style="padding-left: 10%;" class="add_more">
                              </div>
                              <div class="col-md-1" style="padding: unset;">
                                <input id="remove_0"   type="image" src="https://basebear.com/images/datagrid/remove.png" style="visibility:hidden !important;padding-left: 10%;">
                              </div>
                          </div>
                      </div>

                      <div style="display:none;">
                        <input id="value_id" type="text" name="value_id" value="1">
                     </div>
            <button type="button" onclick="SearchItens();" class="btn btn-primary">Search</button>
    </form>
  </div>
</div>

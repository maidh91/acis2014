<script type="text/javascript" src="{{$LAYOUT_HELPER_URL}}front/js/jquery.validate.js"></script>
<link href="{{$LAYOUT_HELPER_URL}}front/css/extend.css" rel="stylesheet" type="text/css" />
<style>
#register td{
	padding-bottom: 15px;
}
</style>
<script type="text/javascript">
function submitForm()
{
	$('#registerform').submit();
}

$().ready(function() {
    // validate signup form on keyup and submit
    $("#registerform").validate({
        rules: {
            'data[name]': "required",        
            'data[message]': "required",      
            'data[mail]': "required"
        },
        messages: {
            'data[name]': "",
            'data[message]': "",
            'data[mail]':""
        }
    });
   
});


</script>


<div class=" w694 p8t p2l">
         
<!--          LEFT-->
           <div class="bg_tt1">
            <p class="tt_intro">Đăng kí</p>
          </div>
          <div style="padding-right:15px" class="border1 p11t p15l p3r p5b text_gioithieu mh787">
          <div style="float:left; width:420px; margin-left: 90px; " >
                        <div>
                        
                        {{if $registerMessage|@count > 0 && true == $registerMessage.success}} 
                        <div class="notification-success">
                        	<div>
                        		{{$registerMessage.message}}
                        	</div>
                        </div> 
			       		{{/if}}
			       		
			       		{{if $errors|@count > 0}}
			       		 <div class="notification-error">
                        	<div>
                        		{{$errors.main}}
                        	</div>
                        </div> 
			       		{{/if}}
			       		 
			       		 
                          <form id="registerform" name="registerform" action="" method="post" id="registerform">
                          <table id="register" width="100%" cellspacing="0" cellpadding="5" border="0">
                           
                            <tbody><tr>
                              <td valign="top"><table width="100%" cellspacing="0" cellpadding="3" border="0" class="style5">
                                  <tbody>
                                  <span class="style17">Ghi chú : <span class="style18">(*)</span> Cần điền thông tin</span>
                                  <br/>
  									&nbsp;
  									&nbsp;
  									&nbsp;
                                  <tr>
                                    <td width="130"><img width="11" height="11" align="absmiddle" src="{{$BASE_URL}}media/userfiles/images/muiten_phai.png"> Họ Tên:<span class="style18">*</span></td>
                                    <td align="left"><input type="text" style="height:25px; width:250px; background:#FFF; border:solid 1px #c8c8c8" name="data[name]"></td>
                                  </tr>
                                  
                                  
                                  <tr>
						              <td width="130"><img width="11" height="11" align="absmiddle" src="{{$BASE_URL}}media/userfiles/images/muiten_phai.png"> Giới Tính:</td>
						              <td colspan="2">
						                    <input type="radio" id="data[sex]" name="data[sex]" value="0" {{if 0 == $data.sex}} checked="checked" {{/if}}>Nam
						                    &nbsp;
						                    &nbsp;
						                    <input type="radio" id="data[sex]" name="data[sex]" value="1" {{if 1 == $data.sex}} checked="checked" {{/if}} >Nữ
						                </td>
						            </tr>
						           
						            
						            <tr>
									    <td width="140"><img width="11" height="11" align="absmiddle" src="{{$BASE_URL}}media/userfiles/images/muiten_phai.png"> Ngày Sinh:</td>
									    <td colspan="2"><select name="data[date]" id="data[date]" value="{{$data.date}}" style="width: 70px; height: 25px; background:#FFF;   border:solid 1px #c8c8c8;">
									    <option value="">Date</option>
									    <option value="1">1</option>
									    <option value="2">2</option>
									    <option value="3">3</option>
									    <option value="4">4</option>
									    <option value="5">5</option>
									    <option value="6">6</option>
									    <option value="7">7</option>
									    <option value="8">8</option>
									    <option value="9">9</option>
									    <option value="10">10</option>
									    <option value="11">11</option>
									    <option value="12">12</option>
									    <option value="13">13</option>
									    <option value="14">14</option>
									    <option value="15">15</option>
									    <option value="16">16</option>
									    <option value="17">17</option>
									    <option value="18">18</option>
									    <option value="19">19</option>
									    <option value="20">20</option>
									    <option value="21">21</option>
									    <option value="22">22</option>
									    <option value="2">23</option>
									    <option value="24">24</option>
									    <option value="25">25</option>
									    <option value="26">26</option>
									    <option value="27">27</option>
									    <option value="28">28</option>
									    <option value="29">29</option>
									    <option value="30">30</option>
									    <option value="31">31</option>
									
									</select>
									    &nbsp;
									    &nbsp;
									    &nbsp;
									    <select name="data[month]" id="data[month]" value="{{$data.month}}" style="width: 70px; height: 25px; background:#FFF;   border:solid 1px #c8c8c8; ">
									    <option value="">Month</option>
									    <option value="01">Jan</option>
									    <option value="02">Feb</option>
									    <option value="03">Mar</option>
									    <option value="04">Apr</option>
									    <option value="05">May</option>
									    <option value="06">Jun</option>
									    <option value="07">Jul</option>
									    <option value="08">Aug</option>
									    <option value="09">Sep</option>
									    <option value="10">Oct</option>
									    <option value="11">Nov</option>
									    <option value="12">Dec</option>
									</select>
									    &nbsp;
									    &nbsp;
									    &nbsp;
									    <select name="data[year]" id="data[year]" value="{{$data.year}}"  style="width: 70px; height: 25px; background:#FFF;   border:solid 1px #c8c8c8;">
									    <option value="">Year</option>
									    <option value="2002">2002</option>
									    <option value="2001">2001</option>
									    <option value="2000">2000</option>
									    <option value="1999">1999</option>
									    <option value="1998">1998</option>
									    <option value="1997">1997</option>
									    <option value="1996">1996</option>
									    <option value="1995">1995</option>
									    <option value="1994">1994</option>
									    <option value="1993">1993</option>
									    <option value="1992">1992</option>
									    <option value="1991">1991</option>
									    <option value="1990">1990</option>
									    <option value="1989">1989</option>
									    <option value="1988">1988</option>
									    <option value="1987">1987</option>
									    <option value="1986">1986</option>
									    <option value="1985">1985</option>
									    <option value="1984">1984</option>
									    <option value="1983">1983</option>
									    <option value="1982">1982</option>
									    <option value="1981">1981</option>
									    <option value="1980">1980</option>
									    <option value="1979">1979</option>
									    <option value="1978">1978</option>
									    <option value="1977">1977</option>
									    <option value="1976">1976</option>
									    <option value="1975">1975</option>
									    <option value="1974">1974</option>
									    <option value="1973">1973</option>
									    <option value="1972">1972</option>
									    <option value="1971">1971</option>
									    <option value="1970">1970</option>
									    <option value="1969">1969</option>
									    <option value="1968">1968</option>
									    <option value="1967">1967</option>
									    <option value="1966">1966</option>
									    <option value="1965">1965</option>
									    <option value="1964">1964</option>
									    <option value="1963">1963</option>
									    <option value="1962">1962</option>
									    <option value="1961">1961</option>
									    <option value="1960">1960</option>
									    <option value="1959">1959</option>
									    <option value="1958">1958</option>
									    <option value="1957">1957</option>
									    <option value="1956">1956</option>
									    <option value="1955">1955</option>
									    <option value="1954">1954</option>
									    <option value="1953">1953</option>
									    <option value="1952">1952</option>
									    <option value="1951">1951</option>
									    <option value="1950">1950</option>
									    <option value="1949">1949</option>
									    <option value="1948">1948</option>
									    <option value="1947">1947</option>
									    <option value="1946">1946</option>
									    <option value="1945">1945</option>
									    <option value="1944">1944</option>
									    <option value="1943">1943</option>
									    <option value="1942">1942</option>
									    <option value="1941">1941</option>
									    <option value="1940">1940</option>
									    <option value="1939">1939</option>
									    <option value="1938">1938</option>
									    <option value="1937">1937</option>
									    <option value="1936">1936</option>
									    <option value="1935">1935</option>
									    <option value="1934">1934</option>
									    <option value="1933">1933</option>
									    <option value="1932">1932</option>
									    <option value="1931">1931</option>
									    <option value="1930">1930</option>
									    <option value="1929">1929</option>
									    <option value="1928">1928</option>
									    <option value="1927">1927</option>
									    <option value="1926">1926</option>
									    <option value="1925">1925</option>
									    <option value="1924">1924</option>
									    <option value="1923">1923</option>
									    <option value="1922">1922</option>
									    <option value="1921">1921</option>
									    <option value="1920">1920</option>
									</select></td>
								</tr>
									            
            
                                  <tr>
                                    <td><img width="11" height="11" align="absmiddle" src="{{$BASE_URL}}media/userfiles/images/muiten_phai.png"> Địa chỉ:<span class="style18">*</span></td>
                                    <td><input type="text" style="height:25px; width:250px; background:#FFF; border:solid 1px #c8c8c8" name="data[address]"></td>
                                  </tr>
                                  
                                  
                                  <tr>
						              <td><img width="11" height="11" align="absmiddle" src="{{$BASE_URL}}media/userfiles/images/muiten_phai.png"> Tỉnh/TP:</td>
						              <td colspan="2"><select name="data[province]" id="data[province]" style="background:#FFF;   border:solid 1px #c8c8c8; width: 250px; height: 25px;">
						                    <option value="">Select</option>
						                    {{foreach from=$city item=item}}
						                    <option value="{{$item.name}}">{{$item.name}}</option>
						                    {{/foreach}}
						                     </select></td>
						            </tr>
            
            
                                  <tr>
                                    <td><img width="11" height="11" align="absmiddle" src="{{$BASE_URL}}media/userfiles/images/muiten_phai.png"> Email:</td>
                                    <td><input type="text" style="height:25px; width:250px; background:#FFF; border:solid 1px #c8c8c8" id="data[email]" name="data[email]"></td>
                                  </tr>
                                  <tr>
                                    <td><img width="11" height="11" align="absmiddle" src="{{$BASE_URL}}media/userfiles/images/muiten_phai.png"> Điện Thoại:<span class="style18">*</span></td>
                                    <td><input type="text" style="height:25px; width:250px; background:#FFF; border:solid 1px #c8c8c8" id="data[phone]" name="data[phone]"></td>
                                  </tr>
                                    
                                    <tr>
              <td><img width="11" height="11" align="absmiddle" src="{{$BASE_URL}}media/userfiles/images/muiten_phai.png"> Nghề Nghiệp:</td>
              <td colspan="3"><select name="data[job]" id="data[job]" style="background:#FFF;   border:solid 1px #c8c8c8; width: 250px; height: 25px; ">
                    <option value="" selected="selected">Chọn nghề nghiệp</option>
                    {{foreach from=$job item=item}}
                    <option value="{{$item.name}}">{{$item.name}}</option>
                    {{/foreach}}
                    </select></td>
            </tr>
            
            <tr>
               <td><img width="11" height="11" align="absmiddle" src="{{$BASE_URL}}media/userfiles/images/muiten_phai.png"> Chương Trình:</td>
              <td colspan="3"><select name="data[program]" id="data[program]" style="background:#FFF;   border:solid 1px #c8c8c8;width: 250px;height: 25px;">
                    <option value="" selected="selected" >Chọn chương trình</option>
                    {{foreach from=$training item=item}}
                     <option value="{{$item.name}}" >{{$item.name}}</option>
                    {{/foreach}}
                    </select></td>
            </tr>
                  
            <tr>
                 <td><img width="11" height="11" align="absmiddle" src="{{$BASE_URL}}media/userfiles/images/muiten_phai.png"> Nguồn Tin:</td>
              <td colspan="3"><select id="data[program]" name="data[source]" style="background:#FFF;   border:solid 1px #c8c8c8;width: 250px; height: 25px;">
                    <option value="" selected="selected">Chọn nguồn tin</option> 
                    {{foreach from=$source item=item}}
                    <option value="{{$item.name}}">{{$item.name}}</option>
                    {{/foreach}}
                    </select></td>
            </tr>
            
            <tr>
               <td><img width="11" height="11" align="absmiddle" src="{{$BASE_URL}}media/userfiles/images/muiten_phai.png"> Thông Tin Thêm:</td>
              <td colspan="3"><textarea name="data[comment]" rows="3" cols="20" id="data[comment]" value="{{$data.comment}}" style="background:#FFF;   border:solid 1px #c8c8c8; height: 74px; width: 250px;" class="InputStyle2"></textarea></td>
            </tr>
         </tbody></table></td>
          </tr>
         
          <tr>
          <td><a class="btn_send" href="javascript: send();"><span></span></a>
          </td>
                              
          </tr>
          </tbody></table>
          <input style="padding-left: 145px;" onclick="javascript:submitForm();" name="" type="image" src="{{$LAYOUT_HELPER_URL}}front/images/bt_gui1_{{$LANG_CODE}}.jpg" /><br class="cb" />
            <br class="cb" />
          </form>
          </div>
          </div>

          </div>

		<div class="border1">
		          <p class=" float_right trove m5t m3r m5b"><a href="javascript:history.back();">Trở về</a></p>
		          <div class="cb"></div>
		</div>
<!--          End Left-->
        </div>








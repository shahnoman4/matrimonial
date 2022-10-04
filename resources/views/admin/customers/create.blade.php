@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
$( document ).ready(function() {
        //swal("Success", "{{session('success')}}", "success");

  swal({
    text: "{{session('success')}}",
    icon: "success",
    //dangerMode: true,
    buttons: ["Go Back", "Add Another"],
    }) .then((willDelete) => {
    if (willDelete) { 
    console.log('Add Another');  
    }else{
    window.location = "{{url('customers')}}";
    console.log('Go Back');  
    }
  });
});
      
    </script>
@endif
<!-- some CSS styling changes and overrides -->
<style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 213px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
</style>
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add Customers</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
            <form class="form-horizontal" action="{!! route('customers.store'); !!}" method="post" enctype="multipart/form-data" id="add-form">
            @csrf
            <div class="box-body" >
            <div class="row">
              <!--for input-->
              <div class="col-md-8">
                <div class="form-group">
                  <label for="fname" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{ old('name') }}" require >
                   <span class="text-red">
                      <strong class="name"></strong>
                    </span>
                  </div>
                </div>
                

                <div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" require>
                    <span class="text-red">
                                <strong class="email"></strong>
                      </span>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="password" class="col-sm-3 control-label">Password</label>

                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" require>
                    <span class="text-red">
                                <strong class="password"></strong>
                      </span>
                  </div>
                </div>
               

               

                <div class="form-group">
                  <label for="mobile" class="col-sm-3 control-label">Mobile</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{ old('mobile') }}" autocomplete="off" require>
                    <span class="text-red">
                                <strong class="mobile"></strong>
                      </span>
                  </div>
                </div>
              </div>
              
              
              <!--for input end-->
              <!--for image-->
              <div class="col-md-4 text-center">
                  <div class="kv-avatar">
                      <div class="file-loading">
                          
                          <input id="avatar-1" name="avatar-1" type="file">
                      </div>
                  </div>
                  <div class="kv-avatar-hint"><small>Select file < 1000 KB</small></div>
              </div>
              <!--for image end-->
            </div>


          <div class="row">
              <div class="col-md-12 text-center">
                  
                <div class="form-group">
                  <label for="user_type" class="col-sm-2 control-label">User Type</label>
                  <div class="col-sm-6">
                      <select type="text" class="form-control" id="user_type" name="user_type">
                       <option value="">Choose Option</option>
                       <option value="Featured">Featured</option>
                       <option value="Daily Recommendation">Daily Recommendation</option>
                       <option value="Normal">Normal</option>
                    </select >
                    <span class="text-red">
                                <strong class="user_type"></strong>
                    </span>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="user_identity" class="col-sm-2 control-label">User Identity</label>
                  <div class="col-sm-6">
                      <select type="text" class="form-control" id="user_identity" name="user_identity">
                       <option value="">Choose Option</option>
                       <option value="Real">Real</option>
                       <option value="Fake">Fake</option>
                    </select >
                    <span class="text-red">
                                <strong class="user_identity"></strong>
                    </span>
                  </div>
                </div>
                
                 <div class="form-group">
                  <label for="profile_created_by" class="col-sm-2 control-label">Created By</label>

                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="profile_created_by" name="profile_created_by">
                       <option value="">Choose Option</option>
                       <option value="Self">Self</option>
                       <option value="Parents">Parents</option>
                       <option value="Sibling">Sibling</option>
                       <option value="Relative">Relative</option>
                       <option value="Friend">Friend</option>
                    </select >  
                    <span class="text-red">
                                <strong class="profile_created_by"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="gender" class="col-sm-2 control-label">Gender</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="gender" name="gender">
                       <option value="">Choose Option</option>
                       <option value="Male">Male</option>
                       <option value="Female">Female</option>
                    </select >  
                    <span class="text-red">
                                <strong class="gender"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="date_of_birth" class="col-sm-2 control-label">Date of birth</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth"  data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{ old('date_of_birth') }}" autocomplete="off" require>
                    <span class="text-red">
                                <strong class="date_of_birth"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_country" class="col-sm-2 control-label">My Country</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="my_country" name="my_country">
                       <option value="">Choose Country</option>
                       @foreach($data['countries'] as $row)
                       <option value="{{$row->country_name}}">{{$row->country_name}}</option>
                       @endforeach
                    </select >  
                    <span class="text-red">
                                <strong class="my_country"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_country_choice" class="col-sm-2 control-label">My Choice Country</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="my_country_choice" name="my_country_choice">
                       <option value="">Choose Option</option>
                       @foreach($data['countries'] as $row)
                       <option value="{{$row->country_name}}">{{$row->country_name}}</option>
                       @endforeach
                    </select >  
                    <span class="text-red">
                                <strong class="my_country_choice"></strong>
                      </span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="my_city" class="col-sm-2 control-label">My City</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="my_city" name="my_city" placeholder="" value="{{ old('my_city') }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="my_city"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_city" class="col-sm-2 control-label">My Choice City</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="my_choice_city" name="my_choice_city" placeholder="" value="{{ old('my_choice_city') }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="my_choice_city"></strong>
                      </span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="religion" class="col-sm-2 control-label">Religion</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="religion" name="religion">
                       <option value="">Choose Option</option>
                       <option value="Christianity">Christianity</option>
                       <option value="Islam-shia">Islam-shia</option>
                       <option value="Islam-sunnis">Islam-sunnis</option>
                       <option value="Islam-Brailvi">Islam-Brailvi</option>
                       <option value="Islam-Deobandi">Islam-Deobandi</option>
                       <option value="Islam-Wahabi">Islam-Wahabi</option>
                       <option value="Islam-Abbasi">Islam-Abbasi</option>
                       <option value="Qadyani">Qadyani</option>
                       <option value="Ahmadi">Ahmadi</option>
                       <option value="Nonreligious">Nonreligious</option>
                       <option value="Hinduism">Hinduism</option>
                       <option value="Chinese traditional religion">Chinese traditional religion</option>
                       <option value="Buddhism">Buddhism</option>
                       <option value="Primal-indigenous">Primal-indigenous</option>
                       <option value="African traditional and Diasporic">African traditional and Diasporic</option>
                       <option value="Sikhism">Sikhism</option>
                       <option value="Juche">Juche</option>
                       <option value="Spiritism">Spiritism</option>
                       <option value="Judaism">Judaism</option>
                       <option value="Bahai">Bahai</option>
                       <option value="Jainism">Jainism</option>
                       <option value="Shinto">Shinto</option>
                       <option value="Cao Dai">Cao Dai</option>
                       <option value="Zoroastrianism">Zoroastrianism</option>
                       <option value="Tenrikyo">Tenrikyo</option>
                       <option value="Neo-Paganism">Neo-Paganism</option>
                       <option value="Unitarian-Universalism">Unitarian-Universalism</option>
                    </select >  
                    <span class="text-red">
                                <strong class="religion"></strong>
                      </span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="mother_tongue" class="col-sm-2 control-label">Mother Tongue</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="mother_tongue" name="mother_tongue">
                       <option value="">Choose Option</option>
                       <option value="Chinese">Chinese</option>
                       <option value="Spanish">Spanish</option>
                       <option value="English">English</option>
                       <option value="Arabic">Arabic</option>
                       <option value="Portuguese">Portuguese</option>
                       <option value="Russian">Russian</option>
                       <option value="Japanese">Japanese</option>
                       <option value="Lahnda">Lahnda</option>
                       <option value="Javanese">Javanese</option>
                       <option value="German">German</option>
                       <option value="Korean">Korean</option>
                       <option value="French">French</option>
                       <option value="Vietnamese">Vietnamese</option>
                       <option value="Bengali">Bengali</option>
                       <option value="Hindi">Hindi</option>
                       <option value="Telugu">Telugu</option>
                       <option value="Marathi">Marathi</option>
                       <option value="Tamil">Tamil</option>
                       <option value="Gujarati">Gujarati</option>
                       <option value="Maithili">Maithili</option>
                       <option value="Kannada">Kannada</option>
                       <option value="Urdu">Urdu</option>
                       <option value="Punjabi">Punjabi</option>
                       <option value="Pashtu">Pashtu</option>
                       <option value="Sindhi">Sindhi</option>
                       <option value="Hinko">Hinko</option>
                       <option value="Balochi">Balochi</option>
                       <option value="Kashmiri">Kashmiri</option>
                       <option value="Balti">Balti</option>
                    </select >  
                    <span class="text-red">
                                <strong class="mother_tongue"></strong>
                      </span>
                  </div>
                </div>                    
                
                <div class="form-group">
                  <label for="my_visa" class="col-sm-2 control-label">My Visa</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_visa" name="my_visa" value="Citizen" style="margin-left: 12px;">Citizen
                    <input type="radio"  id="my_visa" name="my_visa" value="Permanent Resident" style="margin-left: 12px;">Permanent Resident
                    <input type="radio"  id="my_visa" name="my_visa" value="Work visa" style="margin-left: 12px;">Work visa
                    <input type="radio"  id="my_visa" name="my_visa" value="Student visa" style="margin-left: 12px;">Student visa 
                    <input type="radio"  id="my_visa" name="my_visa" value="Other" style="margin-left: 12px;">Other
                    <br>
                    <span class="text-red">
                      <strong class="my_visa"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_visa" class="col-sm-2 control-label">My Choice Visa</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_visa" name="my_choice_visa[]" value="Citizen" style="margin-left: 12px;">Citizen
                    <input type="checkbox"  id="my_choice_visa" name="my_choice_visa[]" value="Permanent Resident" style="margin-left: 12px;">Permanent Resident
                    <input type="checkbox"  id="my_choice_visa" name="my_choice_visa[]" value="Work visa" style="margin-left: 12px;">Work visa
                    <input type="checkbox"  id="my_choice_visa" name="my_choice_visa[]" value="Student visa" style="margin-left: 12px;">Student visa 
                    <input type="checkbox"  id="my_choice_visa" name="my_choice_visa[]" value="Other" style="margin-left: 12px;">Other
                    <input type="checkbox"  id="my_choice_visa" name="my_choice_visa[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_visa"></strong>
                    </span>
                  </div>
                </div>


                 <div class="form-group">
                  <label for="my_physique" class="col-sm-2 control-label">My Physique</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_physique" name="my_physique" value="Slim" style="margin-left: 12px;">Slim
                    <input type="radio"  id="my_physique" name="my_physique" value="Athletic" style="margin-left: 12px;">Athletic
                    <input type="radio"  id="my_physique" name="my_physique" value="Average" style="margin-left: 12px;">Average
                    <input type="radio"  id="my_physique" name="my_physique" value="Few Extra Pounds" style="margin-left: 12px;">Few Extra Pounds
                    <input type="radio"  id="my_physique" name="my_physique" value="Ower Weignt" style="margin-left: 12px;">Ower Weignt
                    <br>
                    <span class="text-red">
                      <strong class="my_physique"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_physique" class="col-sm-2 control-label">My Choice Physique</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_physique" name="my_choice_physique[]" value="Slim" style="margin-left: 12px;">Slim
                    <input type="checkbox"  id="my_choice_physique" name="my_choice_physique[]" value="Athletic" style="margin-left: 12px;">Athletic
                    <input type="checkbox"  id="my_choice_physique" name="my_choice_physique[]" value="Average" style="margin-left: 12px;">Average
                    <input type="checkbox"  id="my_choice_physique" name="my_choice_physique[]" value="Few Extra Pounds" style="margin-left: 12px;">Few Extra Pounds 
                    <input type="checkbox"  id="my_choice_physique" name="my_choice_physique[]" value="Ower Weignt" style="margin-left: 12px;">Ower Weignt
                    <input type="checkbox"  id="my_choice_physique" name="my_choice_physique[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_physique"></strong>
                    </span>
                  </div>
                </div>  

                 <div class="form-group">
                  <label for="my_complexion" class="col-sm-2 control-label">My Complexion</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_complexion" name="my_complexion" value="Very Fair" style="margin-left: 12px;">Very Fair
                    <input type="radio"  id="my_complexion" name="my_complexion" value="Light / Fair" style="margin-left: 12px;">Light / Fair
                    <input type="radio"  id="my_complexion" name="my_complexion" value="Wheatish" style="margin-left: 12px;">Wheatish
                    <input type="radio"  id="my_complexion" name="my_complexion" value="Dark" style="margin-left: 12px;">Dark 
                    <br>
                    <span class="text-red">
                      <strong class="my_complexion"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_complexion" class="col-sm-2 control-label">My Choice Complexion</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_complexion" name="my_choice_complexion[]" value="Very Fair" style="margin-left: 12px;">Very Fair
                    <input type="checkbox"  id="my_choice_complexion" name="my_choice_complexion[]" value="Light / Fair" style="margin-left: 12px;">Light / Fair
                    <input type="checkbox"  id="my_choice_complexion" name="my_choice_complexion[]" value="Wheatish" style="margin-left: 12px;">Wheatish
                    <input type="checkbox"  id="my_choice_complexion" name="my_choice_complexion[]" value="Dark" style="margin-left: 12px;">Dark 
                    <input type="checkbox"  id="my_choice_complexion" name="my_choice_complexion[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_complexion"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_hair_color" class="col-sm-2 control-label">My Hair Color</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_hair_color" name="my_hair_color" value="Black" style="margin-left: 12px;">Black
                    <input type="radio"  id="my_hair_color" name="my_hair_color" value="Brown" style="margin-left: 12px;">Brown
                    <input type="radio"  id="my_hair_color" name="my_hair_color" value="Blonde" style="margin-left: 12px;">Blonde
                    <input type="radio"  id="my_hair_color" name="my_hair_color" value="Red" style="margin-left: 12px;">Red 
                    <input type="radio"  id="my_hair_color" name="my_hair_color" value="Gray" style="margin-left: 12px;">Gray 
                    <input type="radio"  id="my_hair_color" name="my_hair_color" value="Blade(Not Shaved)" style="margin-left: 12px;">Blade(Not Shaved) 
                    <br>
                    <span class="text-red">
                      <strong class="my_hair_color"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_hair_color" class="col-sm-2 control-label">My Choice Hair Color</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Black" style="margin-left: 12px;">Black
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Brown" style="margin-left: 12px;">Brown
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Blonde" style="margin-left: 12px;">Blonde
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Red" style="margin-left: 12px;">Red 
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Gray" style="margin-left: 12px;">Gray 
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Blade(Not Shaved)" style="margin-left: 12px;">Blade(Not Shaved) 
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_hair_color"></strong>
                    </span>
                  </div>
                </div> 

               <div class="form-group">
                  <label for="my_eye_color" class="col-sm-2 control-label">My Eye Color</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_eye_color" name="my_eye_color" value="Black" style="margin-left: 12px;">Black
                    <input type="radio"  id="my_eye_color" name="my_eye_color" value="Brown" style="margin-left: 12px;">Brown
                    <input type="radio"  id="my_eye_color" name="my_eye_color" value="Gray" style="margin-left: 12px;">Gray 
                    <input type="radio"  id="my_eye_color" name="my_eye_color" value="Blue" style="margin-left: 12px;">Blue
                    <input type="radio"  id="my_eye_color" name="my_eye_color" value="Green" style="margin-left: 12px;">Green 
                    <input type="radio"  id="my_eye_color" name="my_eye_color" value="Hazel" style="margin-left: 12px;">Hazel 
                    <br>
                    <span class="text-red">
                      <strong class="my_eye_color"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_eye_color" class="col-sm-2 control-label">My Choice Eye Color</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Black" style="margin-left: 12px;">Black
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Brown" style="margin-left: 12px;">Brown
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Gray" style="margin-left: 12px;">Gray 
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Blue" style="margin-left: 12px;">Blue
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Green" style="margin-left: 12px;">Green 
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Hazel" style="margin-left: 12px;">Hazel 
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_eye_color"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_height" class="col-sm-2 control-label">My Height</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="my_height" name="my_height">
                       <option value="">Choose Option</option>
                       <option value="4'5 Feet">4'5 Feet</option>
                       <option value="4'6 Feet">4'6 Feet</option>
                       <option value="4'7 Feet">4'7 Feet</option>
                       <option value="4'8 Feet">4'8 Feet</option>
                       <option value="4'9 Feet">4'9 Feet</option>
                       <option value="5 Feet">5 Feet</option>
                       <option value="5'1 Feet">5'1 Feet</option>
                       <option value="5'2 Feet">5'2 Feet</option>
                       <option value="5'3 Feet">5'3 Feet</option>
                       <option value="5'4 Feet">5'4 Feet</option>
                       <option value="5'5 Feet">5'5 Feet</option>
                       <option value="5'6 Feet">5'6 Feet</option>
                       <option value="5'7 Feet">5'7 Feet</option>
                       <option value="5'8 Feet">5'8 Feet</option>
                       <option value="5'9 Feet">5'9 Feet</option>
                       <option value="6 Feet">6 Feet</option>
                       <option value="6'1 Feet">6'1 Feet</option>
                       <option value="6'2 Feet">6'2 Feet</option>
                       <option value="6'3 Feet">6'3 Feet</option>
                       <option value="6'4 Feet">6'4 Feet</option>
                       <option value="6'5 Feet">6'5 Feet</option>
                       <option value="6'6 Feet">6'6 Feet</option>
                       <option value="6'7 Feet">6'7 Feet</option>
                       <option value="6'8 Feet">6'8 Feet</option>
                       <option value="6'9 Feet">6'9 Feet</option>
                       <option value="7 Feet">7 Feet</option>
                    </select >  
                    <span class="text-red">
                                <strong class="my_height"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_height_from" class="col-sm-2 control-label">My Choice Height From</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="my_choice_height_from" name="my_choice_height_from">
                       <option value="">Choose Option</option>
                       <option value="4'5 Feet">4'5 Feet</option>
                       <option value="4'6 Feet">4'6 Feet</option>
                       <option value="4'7 Feet">4'7 Feet</option>
                       <option value="4'8 Feet">4'8 Feet</option>
                       <option value="4'9 Feet">4'9 Feet</option>
                       <option value="5 Feet">5 Feet</option>
                       <option value="5'1 Feet">5'1 Feet</option>
                       <option value="5'2 Feet">5'2 Feet</option>
                       <option value="5'3 Feet">5'3 Feet</option>
                       <option value="5'4 Feet">5'4 Feet</option>
                       <option value="5'5 Feet">5'5 Feet</option>
                       <option value="5'6 Feet">5'6 Feet</option>
                       <option value="5'7 Feet">5'7 Feet</option>
                       <option value="5'8 Feet">5'8 Feet</option>
                       <option value="5'9 Feet">5'9 Feet</option>
                       <option value="6 Feet">6 Feet</option>
                       <option value="6'1 Feet">6'1 Feet</option>
                       <option value="6'2 Feet">6'2 Feet</option>
                       <option value="6'3 Feet">6'3 Feet</option>
                       <option value="6'4 Feet">6'4 Feet</option>
                       <option value="6'5 Feet">6'5 Feet</option>
                       <option value="6'6 Feet">6'6 Feet</option>
                       <option value="6'7 Feet">6'7 Feet</option>
                       <option value="6'8 Feet">6'8 Feet</option>
                       <option value="6'9 Feet">6'9 Feet</option>
                       <option value="7 Feet">7 Feet</option>
                    </select >  
                    <span class="text-red">
                                <strong class="my_choice_height_from"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_height_to" class="col-sm-2 control-label">My Choice Height To</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="my_choice_height_to" name="my_choice_height_to">
                       <option value="">Choose Option</option>
                       <option value="4'5 Feet">4'5 Feet</option>
                       <option value="4'6 Feet">4'6 Feet</option>
                       <option value="4'7 Feet">4'7 Feet</option>
                       <option value="4'8 Feet">4'8 Feet</option>
                       <option value="4'9 Feet">4'9 Feet</option>
                       <option value="5 Feet">5 Feet</option>
                       <option value="5'1 Feet">5'1 Feet</option>
                       <option value="5'2 Feet">5'2 Feet</option>
                       <option value="5'3 Feet">5'3 Feet</option>
                       <option value="5'4 Feet">5'4 Feet</option>
                       <option value="5'5 Feet">5'5 Feet</option>
                       <option value="5'6 Feet">5'6 Feet</option>
                       <option value="5'7 Feet">5'7 Feet</option>
                       <option value="5'8 Feet">5'8 Feet</option>
                       <option value="5'9 Feet">5'9 Feet</option>
                       <option value="6 Feet">6 Feet</option>
                       <option value="6'1 Feet">6'1 Feet</option>
                       <option value="6'2 Feet">6'2 Feet</option>
                       <option value="6'3 Feet">6'3 Feet</option>
                       <option value="6'4 Feet">6'4 Feet</option>
                       <option value="6'5 Feet">6'5 Feet</option>
                       <option value="6'6 Feet">6'6 Feet</option>
                       <option value="6'7 Feet">6'7 Feet</option>
                       <option value="6'8 Feet">6'8 Feet</option>
                       <option value="6'9 Feet">6'9 Feet</option>
                       <option value="7 Feet">7 Feet</option>
                    </select >  
                    <span class="text-red">
                                <strong class="my_choice_height_to"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_age_from" class="col-sm-2 control-label">My Choice Age From</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="my_choice_age_from" name="my_choice_age_from">
                       <option value="">Choose Option</option>
                       @for($i=18; $i<=70;$i++)
                       <option value="{{$i}} Years">{{$i}} Years</option>
                       @endfor
                    </select >  
                    <span class="text-red">
                                <strong class="my_choice_age_from"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_age_to" class="col-sm-2 control-label">My Choice Age To</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="my_choice_age_to" name="my_choice_age_to">
                       <option value="">Choose Option</option>
                       @for($i=18; $i<=70;$i++)
                       <option value="{{$i}} Years">{{$i}} Years</option>
                       @endfor
                    </select >  
                    <span class="text-red">
                                <strong class="my_choice_age_to"></strong>
                      </span>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="education" class="col-sm-2 control-label">My Education</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="education" name="education">
                       <option value="">Choose Option</option>
                       <option value="Doctorate Degree (Ph.D)">Doctorate Degree (Ph.D)</option>
                       <option value="Doctor (Medical)">Doctor (Medical)</option>
                       <option value="Doctor (Dental)">Doctor (Dental)</option>
                       <option value="Engineering">Engineering</option>
                       <option value="Master\'s Degree">Master\'s Degree</option>
                       <option value="Bachelor\'s Degree">Bachelor\'s Degree</option>
                       <option value="College Graduate">College Graduate</option>
                       <option value="Associate\'s Degree">Associate\'s Degree</option>
                       <option value="Diploma">Diploma</option>
                       <option value="High school">High school</option>
                       <option value="Intermediate">Intermediate</option>
                       <option value="A-Level">A-Level</option>
                       <option value="Matriculate">Matriculate</option>
                       <option value="O-Level">O-Level</option>
                       <option value="Middle School">Middle School</option>
                       <option value="Primary School">Primary School</option>
                       <option value="Never Been to School">Never Been to School</option>
                       <option value="other">other</option>
                       <option value="Religious Education">Religious Education</option>
                       <option value="Professional Certificate">Professional Certificate</option>
                       <option value="Master of philosophy ( M.Phil)">Master of philosophy ( M.Phil)</option>
                       
                    </select >  
                    <span class="text-red">
                                <strong class="education"></strong>
                      </span>
                  </div>
                </div>  
                <div class="form-group">
                  <label for="education_field" class="col-sm-2 control-label">My Education Field</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="education_field" name="education_field">
                       <option value="">Choose Option</option>
                       <option value="Administrative services">Administrative services</option>
                       <option value="Adervertising / Marketing">Adervertising / Marketing</option>
                       <option value="Agriculture">Agriculture</option>
                       <option value="Architecture">Architecture</option>
                       <option value="Armed Forces">Armed Forces</option>
                       <option value="Arts">Arts</option>
                       <option value="Biology and Biomedical Sciences">Biology and Biomedical Sciences</option>
                       <option value="Business">Business</option>
                       <option value="Commerce">Commerce</option>
                       <option value="Communication and Journalism">Communication and Journalism</option>
                       <option value="Computer Science">Computer Science</option>
                       <option value="Computers / IT">Computers / IT</option>
                       <option value="Cosmetology">Cosmetology</option>
                       <option value="Culinary Arts and Personal Services">Culinary Arts and Personal Services</option>
                       <option value="Education">Education</option>
                       <option value="Engineering and Technology">Engineering and Technology</option>
                       <option value="Fashion">Fashion</option>
                       <option value="Fine Arts">Fine Arts</option>
                       <option value="Food Safty and quality">Food Safty and quality</option>
                       <option value="Forestry">Forestry</option>
                       <option value="HR">HR</option>
                       <option value="Health Sciences">Health Sciences</option>
                       <option value="Homeopathic">Homeopathic</option>
                       <option value="Law">Law</option>
                       <option value="Legal">Legal</option>
                       <option value="Liberal Arts and Humanities">Liberal Arts and Humanities</option>
                       <option value="Management">Management</option>
                       <option value="Mechanic and Repair Technologies">Mechanic and Repair Technologies</option>
                       <option value="Medical and health professional">Medical and health professional</option>
                       <option value="Medicine">Medicine</option>
                       <option value="Music">Music</option>
                       <option value="Nursing">Nursing</option>
                       <option value="Office Administration">Office Administration</option>
                       <option value="other / General">other / General</option>
                       <option value="Physical Sciences">Physical Sciences</option>
                       <option value="Psychology">Psychology</option>
                       <option value="Real Estate">Real Estate</option>
                       <option value="Religious Studies">Religious Studies</option>
                       <option value="Science">Science</option>
                       <option value="Social work">Social work</option>
                       <option value="Special Education">Special Education</option>
                       <option value="Theatre Arts">Theatre Arts</option>
                       <option value="Transpotation and Distribution">Transpotation and Distribution</option>
                       <option value="Travel and Tourism">Travel and Tourism</option>
                       <option value="Veterinary Services">Veterinary Services</option>
                       <option value="Visual and Performing Arts">Visual and Performing Arts</option>
                    </select >  
                    <span class="text-red">
                                <strong class="education_field"></strong>
                      </span>
                  </div>
                </div>  
                <div class="form-group">
                  <label for="education_field_year" class="col-sm-2 control-label">Graduation Year</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="education_field_year" name="education_field_year">
                       <option value="">Choose Option</option>
                       @for($i=2019; $i>=1975;$i--)
                       <option value="{{$i}}">{{$i}}</option>
                       @endfor
                    </select >  
                    <span class="text-red">
                                <strong class="education_field_year"></strong>
                      </span>
                  </div>
                </div>  
                <div class="form-group">
                  <label for="my_occupation" class="col-sm-2 control-label">My Occupation</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="my_occupation" name="my_occupation">
                       <option value="">Choose Option</option>
                       <option value="Accounting / Auditing">Accounting / Auditing</option>
                       <option value="Administrative">Administrative</option>
                       <option value="Advertisign / Marketing">Advertisign / Marketing</option>
                       <option value="Agriculture / Forestry">Agriculture / Forestry</option>
                       <option value="Architectural Services">Architectural Services</option>
                       <option value="Armed Forces / Military">Armed Forces / Military</option>
                       <option value="Arts / Entertainment / Media">Arts / Entertainment / Media</option>
                       <option value="Automotive / Motor Vehicle / Parts">Automotive / Motor Vehicle / Parts</option>
                       <option value="Aviation / Aerospace">Aviation / Aerospace</option>
                       <option value="Banking">Banking</option>
                       <option value="Biotechnology / Pharmaceutical">Biotechnology / Pharmaceutical</option>
                       <option value="Building and Ground Maintenance">Building and Ground Maintenance</option>
                       <option value="Clerical">Clerical</option>
                       <option value="Computer , Hardware">Computer , Hardware</option>
                       <option value="Computer , Software">Computer , Software</option>
                       <option value="Construction / Labor">Construction / Labor</option>
                       <option value="Consulting Services">Consulting Services</option>
                       <option value="Engineering">Engineering</option>
                       <option value="Executive / Management">Executive / Management</option>
                       <option value="Finance / Economics">Finance / Economics</option>
                       <option value="Financial services">Financial services</option>
                       <option value="Government Employee">Government Employee</option>
                       <option value="Healthcare - Medical Practitioners">Healthcare - Medical Practitioners</option>
                       <option value="Healthcare - Dental Practitioners">Healthcare - Dental Practitioners</option>
                       <option value="Healthcare - Para Medical / Nursing">Healthcare - Para Medical / Nursing</option>
                       <option value="Healthcare - Radiology / Imaging">Healthcare - Radiology / Imaging</option>
                       <option value="Information Technology">Information Technology</option>
                       <option value="Installation / Maintenance / Repair">Installation / Maintenance / Repair</option>
                       <option value="Insurance">Insurance</option>
                       <option value="Internet / E-Commerce">Internet / E-Commerce</option>
                       <option value="Law Enforcement / Security">Law Enforcement / Security</option>
                       <option value="Legal">Legal</option>
                       <option value="Manufacturing / production">Manufacturing / production</option>
                       <option value="Publishing / Printing">Publishing / Printing</option>
                       <option value="Real Estate / Mortgage">Real Estate / Mortgage</option>
                       <option value="Recruiting / Human Resource">Recruiting / Human Resource</option>
                       <option value="Restaurant / Food Services">Restaurant / Food Services</option>
                       <option value="Retail / Wholesale">Retail / Wholesale</option>
                       <option value="Sales">Sales</option>
                       <option value="Sales and Marketing">Sales and Marketing</option>
                       <option value="Self Employed">Self Employed</option>
                       <option value="Sports and Recreation">Sports and Recreation</option>
                       <option value="Student">Student</option>
                       <option value="Teacher / professor / Education">Teacher / professor / Education</option>
                       <option value="Telecommunications">Telecommunications</option>
                       <option value="Tourism / Hospitality">Tourism / Hospitality</option>
                       <option value="Transpotation">Transpotation</option>
                       <option value="Unemployed">Unemployed</option>
                       <option value="Retired">Retired</option>
                       <option value="Not working">Not working</option>
                       <option value="Other">Other</option>
                       <option value="Healthcare- Other">Healthcare- Other</option>
                       
                    </select >  
                    <span class="text-red">
                                <strong class="my_occupation"></strong>
                      </span>
                  </div>
                </div>  
                <div class="form-group">
                  <label for="my_choice_occupation" class="col-sm-2 control-label">My Choice Occupation</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="my_choice_occupation" name="my_choice_occupation">
                       <option value="">Choose Option</option>
                       <option value="Accounting / Auditing">Accounting / Auditing</option>
                       <option value="Administrative">Administrative</option>
                       <option value="Advertisign / Marketing">Advertisign / Marketing</option>
                       <option value="Agriculture / Forestry">Agriculture / Forestry</option>
                       <option value="Architectural Services">Architectural Services</option>
                       <option value="Armed Forces / Military">Armed Forces / Military</option>
                       <option value="Arts / Entertainment / Media">Arts / Entertainment / Media</option>
                       <option value="Automotive / Motor Vehicle / Parts">Automotive / Motor Vehicle / Parts</option>
                       <option value="Aviation / Aerospace">Aviation / Aerospace</option>
                       <option value="Banking">Banking</option>
                       <option value="Biotechnology / Pharmaceutical">Biotechnology / Pharmaceutical</option>
                       <option value="Building and Ground Maintenance">Building and Ground Maintenance</option>
                       <option value="Clerical">Clerical</option>
                       <option value="Computer , Hardware">Computer , Hardware</option>
                       <option value="Computer , Software">Computer , Software</option>
                       <option value="Construction / Labor">Construction / Labor</option>
                       <option value="Consulting Services">Consulting Services</option>
                       <option value="Engineering">Engineering</option>
                       <option value="Executive / Management">Executive / Management</option>
                       <option value="Finance / Economics">Finance / Economics</option>
                       <option value="Financial services">Financial services</option>
                       <option value="Government Employee">Government Employee</option>
                       <option value="Healthcare - Medical Practitioners">Healthcare - Medical Practitioners</option>
                       <option value="Healthcare - Dental Practitioners">Healthcare - Dental Practitioners</option>
                       <option value="Healthcare - Para Medical / Nursing">Healthcare - Para Medical / Nursing</option>
                       <option value="Healthcare - Radiology / Imaging">Healthcare - Radiology / Imaging</option>
                       <option value="Information Technology">Information Technology</option>
                       <option value="Installation / Maintenance / Repair">Installation / Maintenance / Repair</option>
                       <option value="Insurance">Insurance</option>
                       <option value="Internet / E-Commerce">Internet / E-Commerce</option>
                       <option value="Law Enforcement / Security">Law Enforcement / Security</option>
                       <option value="Legal">Legal</option>
                       <option value="Manufacturing / production">Manufacturing / production</option>
                       <option value="Publishing / Printing">Publishing / Printing</option>
                       <option value="Real Estate / Mortgage">Real Estate / Mortgage</option>
                       <option value="Recruiting / Human Resource">Recruiting / Human Resource</option>
                       <option value="Restaurant / Food Services">Restaurant / Food Services</option>
                       <option value="Retail / Wholesale">Retail / Wholesale</option>
                       <option value="Sales">Sales</option>
                       <option value="Sales and Marketing">Sales and Marketing</option>
                       <option value="Self Employed">Self Employed</option>
                       <option value="Sports and Recreation">Sports and Recreation</option>
                       <option value="Student">Student</option>
                       <option value="Teacher / professor / Education">Teacher / professor / Education</option>
                       <option value="Telecommunications">Telecommunications</option>
                       <option value="Tourism / Hospitality">Tourism / Hospitality</option>
                       <option value="Transpotation">Transpotation</option>
                       <option value="Unemployed">Unemployed</option>
                       <option value="Retired">Retired</option>
                       <option value="Not working">Not working</option>
                       <option value="Other">Other</option>
                       <option value="Healthcare- Other">Healthcare- Other</option>
                    </select >  
                    <span class="text-red">
                                <strong class="my_choice_occupation"></strong>
                      </span>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="income_level" class="col-sm-2 control-label">Income Level(In local Currency)</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="income_level" name="income_level">
                       <option value="">Choose Option</option>
                       <option value="Less Than 25,000">Less Than 25,000</option>
                       <option value="25,000 to 50,000">25,000 to 50,000</option>
                       <option value="50,000 to 75,000">50,000 to 75,000</option>
                       <option value="75,000 to 100,000">75,000 to 100,000</option>
                       <option value="100,000 to 125,000">100,000 to 125,000</option>
                       <option value="150,000 to 200,000">150,000 to 200,000</option>
                       <option value="200,000+">200,000+</option>
                       <option value="Don\'t want to specify">Don\'t want to specify</option>
                    </select >  
                    <span class="text-red">
                                <strong class="income_level"></strong>
                      </span>
                  </div>
                </div>

                 <div class="form-group">
                  <label for="caste" class="col-sm-2 control-label">Caste</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="caste" name="caste" placeholder="" value="{{ old('caste') }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="caste"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_economy" class="col-sm-2 control-label">My Economy</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_economy" name="my_economy" value="Struggling" style="margin-left: 12px;">Struggling
                    <input type="radio"  id="my_economy" name="my_economy" value="Family Supported" style="margin-left: 12px;">Family Supported
                    <input type="radio"  id="my_economy" name="my_economy" value="Independent" style="margin-left: 12px;">Independent 
                    <input type="radio"  id="my_economy" name="my_economy" value="Settled" style="margin-left: 12px;">Settled
                    <input type="radio"  id="my_economy" name="my_economy" value="Well Settled" style="margin-left: 12px;">Well Settled
                    <br>
                    <span class="text-red">
                      <strong class="my_economy"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_economy" class="col-sm-2 control-label">My Choice Economy</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_economy" name="my_choice_economy[]" value="Struggling" style="margin-left: 5px;">Struggling
                    <input type="checkbox"  id="my_choice_economy" name="my_choice_economy[]" value="Family Supported" style="margin-left: 5px;">Family Supported
                    <input type="checkbox"  id="my_choice_economy" name="my_choice_economy[]" value="Independent" style="margin-left: 5px;">Independent 
                    <input type="checkbox"  id="my_choice_economy" name="my_choice_economy[]" value="Settled" style="margin-left: 5px;">Settled
                    <input type="checkbox"  id="my_choice_economy" name="my_choice_economy[]" value="Well Settled" style="margin-left: 5px;">Well Settled 
                    <input type="checkbox"  id="my_choice_economy" name="my_choice_economy[]" value="Any" style="margin-left: 5px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_economy"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="marital_status" class="col-sm-2 control-label">My Marital Status</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="marital_status" name="marital_status" value="Never Married" style="margin-left: 12px;">Never Married
                    <input type="radio"  id="marital_status" name="marital_status" value="Divorced" style="margin-left: 12px;">Divorced
                    <input type="radio"  id="marital_status" name="marital_status" value="Widowed" style="margin-left: 12px;">Widowed 
                    <input type="radio"  id="marital_status" name="marital_status" value="Separated" style="margin-left: 12px;">Separated
                    <input type="radio"  id="marital_status" name="marital_status" value="Married" style="margin-left: 12px;">Married
                    <br>
                    <span class="text-red">
                      <strong class="marital_status"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_marital_status" class="col-sm-2 control-label">My Choice Marital Status</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_marital_status" name="my_choice_marital_status[]" value="Never Married" style="margin-left: 5px;">Never Married
                    <input type="checkbox"  id="my_choice_marital_status" name="my_choice_marital_status[]" value="Divorced" style="margin-left: 5px;">Divorced
                    <input type="checkbox"  id="my_choice_marital_status" name="my_choice_marital_status[]" value="Widowed" style="margin-left: 5px;">Widowed 
                    <input type="checkbox"  id="my_choice_marital_status" name="my_choice_marital_status[]" value="Separated" style="margin-left: 5px;">Separated
                    <input type="checkbox"  id="my_choice_marital_status" name="my_choice_marital_status[]" value="Married" style="margin-left: 5px;">Married 
                    <input type="checkbox"  id="my_choice_marital_status" name="my_choice_marital_status[]" value="Any" style="margin-left: 5px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_marital_status"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_children" class="col-sm-2 control-label">My Children</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_children" name="my_children" value="No" style="margin-left: 12px;">No
                    <input type="radio"  id="my_children" name="my_children" value="Yes,Not Living With Me" style="margin-left: 12px;">Yes,Not Living With Me
                    <input type="radio"  id="my_children" name="my_children" value="Yes,Living With Me" style="margin-left: 12px;">Yes,Living With Me
                    <br>
                    <span class="text-red">
                      <strong class="my_children"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_children" class="col-sm-2 control-label">My Choice Children</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_children" name="my_choice_children[]" value="No" style="margin-left: 12px;">No
                    <input type="checkbox"  id="my_choice_children" name="my_choice_children[]" value="Yes,Not Living With Me" style="margin-left: 12px;">Yes,Not Living With Me
                    <input type="checkbox"  id="my_choice_children" name="my_choice_children[]" value="Yes,Living With Me" style="margin-left: 12px;">Yes,Living With Me 
                    <input type="checkbox"  id="my_choice_children" name="my_choice_children[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_children"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_sibling_position" class="col-sm-2 control-label">My Sibling Position</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="my_sibling_position" name="my_sibling_position">
                       <option value="">Choose Option</option>
                       <option value="First Child">First Child</option>
                       <option value="Middle Child">Middle Child</option>
                       <option value="Last Child">Last Child</option>
                    </select >  
                    <span class="text-red">
                                <strong class="my_sibling_position"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="no_of_brothers" class="col-sm-2 control-label">No Of Brothers</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="no_of_brothers" name="no_of_brothers" placeholder="" value="{{ old('no_of_brothers') }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="no_of_brothers"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="no_of_sisters" class="col-sm-2 control-label">No Of Sisters</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="no_of_sisters" name="no_of_sisters" placeholder="" value="{{ old('no_of_sisters') }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="no_of_sisters"></strong>
                      </span>
                  </div>
                </div>

                 <div class="form-group">
                  <label for="my_family_values" class="col-sm-2 control-label">My Family Values</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_family_values" name="my_family_values" value="Religious" style="margin-left: 12px;">Religious
                    <input type="radio"  id="my_family_values" name="my_family_values" value="Traditional" style="margin-left: 12px;">Traditional
                    <input type="radio"  id="my_family_values" name="my_family_values" value="Moderate" style="margin-left: 12px;">Moderate 
                    <input type="radio"  id="my_family_values" name="my_family_values" value="Modern" style="margin-left: 12px;">Modern
                    <br>
                    <span class="text-red">
                      <strong class="my_family_values"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_family" class="col-sm-2 control-label">My Choice Family Values</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_family" name="my_choice_family[]" value="Religious" style="margin-left: 12px;">Religious
                    <input type="checkbox"  id="my_choice_family" name="my_choice_family[]" value="Traditional" style="margin-left: 12px;">Traditional
                    <input type="checkbox"  id="my_choice_family" name="my_choice_family[]" value="Moderate" style="margin-left: 12px;">Moderate 
                    <input type="checkbox"  id="my_choice_family" name="my_choice_family[]" value="Modern" style="margin-left: 12px;">Modern
                    <input type="checkbox"  id="my_choice_family" name="my_choice_family[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_family"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_living_arrangement" class="col-sm-2 control-label">My Living Arrangements</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_living_arrangement" name="my_living_arrangement" value="Homeowner" style="margin-left: 12px;">Homeowner
                    <input type="radio"  id="my_living_arrangement" name="my_living_arrangement" value="Rental Apartment" style="margin-left: 12px;">Rental Apartment
                    <input type="radio"  id="my_living_arrangement" name="my_living_arrangement" value="Living With Family" style="margin-left: 12px;">Living With Family 
                    <br>
                    <span class="text-red">
                      <strong class="my_living_arrangement"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_living_arrangement" class="col-sm-2 control-label">My Choice Living Arrangements</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_living_arrangement" name="my_choice_living_arrangement[]" value="Homeowner" style="margin-left: 12px;">Homeowner
                    <input type="checkbox"  id="my_choice_living_arrangement" name="my_choice_living_arrangement[]" value="Rental Apartment" style="margin-left: 12px;">Rental Apartment
                    <input type="checkbox"  id="my_choice_living_arrangement" name="my_choice_living_arrangement[]" value="Living With Family" style="margin-left: 12px;">Living With Family 
                    <input type="checkbox"  id="my_choice_living_arrangement" name="my_choice_living_arrangement[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_living_arrangement"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_raised" class="col-sm-2 control-label">My Raised,Where</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_raised" name="my_raised" value="Eastern Countries" style="margin-left: 12px;">Eastern Countries
                    <input type="radio"  id="my_raised" name="my_raised" value="Western Countries" style="margin-left: 12px;">Western Countries
                    <input type="radio"  id="my_raised" name="my_raised" value="Eastern and Western" style="margin-left: 12px;">Eastern and Western 
                    <br>
                    <span class="text-red">
                      <strong class="my_raised"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_raised" class="col-sm-2 control-label">My Choice Raised,Where</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_raised" name="my_choice_raised[]" value="Eastern Countries" style="margin-left: 12px;">Eastern Countries
                    <input type="checkbox"  id="my_choice_raised" name="my_choice_raised[]" value="Western Countries" style="margin-left: 12px;">Western Countries
                    <input type="checkbox"  id="my_choice_raised" name="my_choice_raised[]" value="Eastern and Western" style="margin-left: 12px;">Eastern and Western 
                    <input type="checkbox"  id="my_choice_raised" name="my_choice_raised[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_raised"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_hijab" class="col-sm-2 control-label">My Hijab</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_hijab" name="my_hijab" value="Very Important" style="margin-left: 12px;">Very Important
                    <input type="radio"  id="my_hijab" name="my_hijab" value="Not Very Important" style="margin-left: 12px;">Not Very Important
                    <br>
                    <span class="text-red">
                      <strong class="my_hijab"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_hijab" class="col-sm-2 control-label">My Choice Hijab</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_hijab" name="my_choice_hijab[]" value="Very Important" style="margin-left: 12px;">Very Important
                    <input type="checkbox"  id="my_choice_hijab" name="my_choice_hijab[]" value="Not Very Important" style="margin-left: 12px;">Not Very Important
                    <input type="checkbox"  id="my_choice_hijab" name="my_choice_hijab[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_hijab"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_smoke" class="col-sm-2 control-label">My Self Smoke</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_smoke" name="my_smoke" value="Non Smoker" style="margin-left: 12px;">Non Smoker
                    <input type="radio"  id="my_smoke" name="my_smoke" value="Sometimes" style="margin-left: 12px;">Sometimes
                    <input type="radio"  id="my_smoke" name="my_smoke" value="Smoker" style="margin-left: 12px;">Smoker 
                    <br>
                    <span class="text-red">
                      <strong class="my_smoke"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_smoke" class="col-sm-2 control-label">My Choice Smoke</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_smoke" name="my_choice_smoke[]" value="Non Smoker" style="margin-left: 12px;">Non Smoker
                    <input type="checkbox"  id="my_choice_smoke" name="my_choice_smoke[]" value="Sometimes" style="margin-left: 12px;">Sometimes
                    <input type="checkbox"  id="my_choice_smoke" name="my_choice_smoke[]" value="Smoker" style="margin-left: 12px;">Smoker 
                    <input type="checkbox"  id="my_choice_smoke" name="my_choice_smoke[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_smoke"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_drink" class="col-sm-2 control-label">My Self Drink</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_drink" name="my_drink" value="Never" style="margin-left: 12px;">Never
                    <input type="radio"  id="my_drink" name="my_drink" value="Occasionally" style="margin-left: 12px;">Occasionally
                    <input type="radio"  id="my_drink" name="my_drink" value="Regularly" style="margin-left: 12px;">Regularly 
                    <br>
                    <span class="text-red">
                      <strong class="my_drink"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_drink" class="col-sm-2 control-label">My Choice Drink</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_drink" name="my_choice_drink[]" value="Never" style="margin-left: 12px;">Never
                    <input type="checkbox"  id="my_choice_drink" name="my_choice_drink[]" value="Occasionally" style="margin-left: 12px;">Occasionally
                    <input type="checkbox"  id="my_choice_drink" name="my_choice_drink[]" value="Regularly" style="margin-left: 12px;">Regularly 
                    <input type="checkbox"  id="my_choice_drink" name="my_choice_drink[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_drink"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_disability" class="col-sm-2 control-label">My Disability</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_disability" name="my_disability" value="No" style="margin-left: 12px;">No
                    <input type="radio"  id="my_disability" name="my_disability" value="Yes i have disability" style="margin-left: 12px;">Yes i have disability
                    <input type="radio"  id="my_disability" name="my_disability" value="Yes but does't impact much" style="margin-left: 12px;">Yes but does't impact much 
                    <br>
                    <span class="text-red">
                      <strong class="my_disability"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_disability" class="col-sm-2 control-label">My Choice Disability</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_disability" name="my_choice_disability[]" value="No" style="margin-left: 12px;">No
                    <input type="checkbox"  id="my_choice_disability" name="my_choice_disability[]" value="Yes i have disability" style="margin-left: 12px;">Yes i have disability
                    <input type="checkbox"  id="my_choice_disability" name="my_choice_disability[]" value="Yes but does't impact much" style="margin-left: 12px;">Yes but does't impact much 
                    <input type="checkbox"  id="my_choice_disability" name="my_choice_disability[]" value="Any" style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_disability"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="interest" class="col-sm-2 control-label">Interest</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="interest" name="interest[]" value="Art" style="margin-left: 12px;">Art
                    <input type="checkbox"  id="interest" name="interest[]" value="Astrology" style="margin-left: 12px;">Astrology 
                    <input type="checkbox"  id="interest" name="interest[]" value="Boats" style="margin-left: 12px;">Boats
                    <input type="checkbox"  id="interest" name="interest[]" value="Community Service" style="margin-left: 12px;">Community Service
                    <input type="checkbox"  id="interest" name="interest[]" value="Cooking" style="margin-left: 12px;">Cooking
                    <input type="checkbox"  id="interest" name="interest[]" value="Dining" style="margin-left: 12px;">Dining
                    <input type="checkbox"  id="interest" name="interest[]" value="Family Life" style="margin-left: 12px;">Family Life
                    <input type="checkbox"  id="interest" name="interest[]" value="Fishing" style="margin-left: 12px;">Fishing
                    <input type="checkbox"  id="interest" name="interest[]" value="Games" style="margin-left: 12px;">Games
                    <input type="checkbox"  id="interest" name="interest[]" value="Health / Fitness" style="margin-left: 12px;">Health / Fitness
                    <input type="checkbox"  id="interest" name="interest[]" value="Hunting" style="margin-left: 12px;">Hunting
                    <input type="checkbox"  id="interest" name="interest[]" value="Learning" style="margin-left: 12px;">Learning
                    <input type="checkbox"  id="interest" name="interest[]" value="Movies / Television" style="margin-left: 12px;">Movies / Television
                    <input type="checkbox"  id="interest" name="interest[]" value="Pets" style="margin-left: 12px;">Pets
                    <input type="checkbox"  id="interest" name="interest[]" value="Singing" style="margin-left: 12px;">Singing
                    <input type="checkbox"  id="interest" name="interest[]" value="Reading" style="margin-left: 12px;">Reading
                    <input type="checkbox"  id="interest" name="interest[]" value="Socialize" style="margin-left: 12px;">Socialize
                    <input type="checkbox"  id="interest" name="interest[]" value="Sewing and Sitching" style="margin-left: 12px;">Sewing and Sitching
                    <input type="checkbox"  id="interest" name="interest[]" value="Traveling" style="margin-left: 12px;">Traveling
                    <input type="checkbox"  id="interest" name="interest[]" value="Volunteering" style="margin-left: 12px;">Volunteering
                    <input type="checkbox"  id="interest" name="interest[]" value="Art and Craft" style="margin-left: 12px;">Art and Craft
                    <input type="checkbox"  id="interest" name="interest[]" value="Bicycling" style="margin-left: 12px;">Bicycling
                    <input type="checkbox"  id="interest" name="interest[]" value="Cars" style="margin-left: 12px;">Cars
                    <input type="checkbox"  id="interest" name="interest[]" value="Computers" style="margin-left: 12px;">Computers
                    <input type="checkbox"  id="interest" name="interest[]" value="Dancing" style="margin-left: 12px;">Dancing
                    <input type="checkbox"  id="interest" name="interest[]" value="Driving" style="margin-left: 12px;">Driving
                    <input type="checkbox"  id="interest" name="interest[]" value="Fashion" style="margin-left: 12px;">Fashion
                    <input type="checkbox"  id="interest" name="interest[]" value="Electronics" style="margin-left: 12px;">Electronics
                    <input type="checkbox"  id="interest" name="interest[]" value="Gardening" style="margin-left: 12px;">Gardening
                    <input type="checkbox"  id="interest" name="interest[]" value="Hosting / Entertaining" style="margin-left: 12px;">Hosting / Entertaining
                    <input type="checkbox"  id="interest" name="interest[]" value="Interior Design" style="margin-left: 12px;">Interior Design
                    <input type="checkbox"  id="interest" name="interest[]" value="Motorcycle" style="margin-left: 12px;">Motorcycle
                    <input type="checkbox"  id="interest" name="interest[]" value="Music" style="margin-left: 12px;">Music
                    <input type="checkbox"  id="interest" name="interest[]" value="Parties" style="margin-left: 12px;">Parties
                    <input type="checkbox"  id="interest" name="interest[]" value="Photography" style="margin-left: 12px;">Photography
                    <input type="checkbox"  id="interest" name="interest[]" value="Politics" style="margin-left: 12px;">Politics
                    <input type="checkbox"  id="interest" name="interest[]" value="Recreational Activites" style="margin-left: 12px;">Recreational Activites
                    <input type="checkbox"  id="interest" name="interest[]" value="Shopping" style="margin-left: 12px;">Shopping
                    <input type="checkbox"  id="interest" name="interest[]" value="Swimming" style="margin-left: 12px;">Swimming
                    <input type="checkbox"  id="interest" name="interest[]" value="Video Games" style="margin-left: 12px;">Video Games
                    <input type="checkbox"  id="interest" name="interest[]" value="Sports" style="margin-left: 12px;">Sports
                    <br>
                    <span class="text-red">
                      <strong class="interest"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_personality" class="col-sm-2 control-label">My Personality</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Charming" style="margin-left: 12px;">Charming
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Extrovert" style="margin-left: 12px;">Extrovert
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Introvert" style="margin-left: 12px;">Introvert 
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Sensitive" style="margin-left: 12px;">Sensitive
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Serious" style="margin-left: 12px;">Serious
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Shy" style="margin-left: 12px;">Shy
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Simple" style="margin-left: 12px;">Simple
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Witty" style="margin-left: 12px;">Witty
                    <br>
                    <span class="text-red">
                      <strong class="my_personality"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="about" class="col-sm-2 control-label">About My Personality</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="about" name="about" placeholder="" value="{{ old('about') }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="about"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="about_my_choice" class="col-sm-2 control-label">About My Choice Personality</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="about_my_choice" name="about_my_choice" placeholder="" value="{{ old('about_my_choice') }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="about_my_choice"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_strengths" class="col-sm-2 control-label">My Strengths</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="my_strengths" name="my_strengths" placeholder="" value="{{ old('my_strengths') }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="my_strengths"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_weekness" class="col-sm-2 control-label">My Weekness</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="my_weekness" name="my_weekness" placeholder="" value="{{ old('my_weekness') }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="my_weekness"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="terms_and_condition" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
                    <input type="checkbox"  id="terms_and_condition" name="terms_and_condition" value="true" style="margin-right: 12px;">Terms and Conditions
                     <span class="text-red">
                      <strong class="terms_and_condition"></strong>
                    </span>
                  </div>
                </div>

               <!-- end fields-->
              </div>
          </div>        

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info" id="add-form-btn">Saved</button>
                <a href="{!! url('/admin/customers'); !!}" class="btn btn-default pull-right">Cancel</a>
              </div>
              <!-- /.box-footer -->
            </form>
</div>

@endsection
@push('scripts')
<!-- InputMask -->
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

<script type="text/javascript">


    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask();

$('#add-form-btn').on('click', function(e) {
  //var data = $('#add-form').serializeArray();
  var data = $('#add-form')[0];
  var formData = new FormData(data);
  event.preventDefault();
  $.ajax({
      data: formData,
      type: $('#add-form').attr('method'),
      url: $('#add-form').attr('action'),
      processData: false,
      contentType: false,
      success: function(response)
      {
      if(response.errors)
      {
        //console.log(response.errors.email);
      $.each(response.errors, function( index, value ) {
        //console.log(value[0]);
      $("."+index).html(value[0]);
      $("."+index).fadeIn('slow', function(){
        $("."+index).delay(30000).fadeOut(); 
      });
      });
      var success = $("."+response.errors.email);
      scrollTo(success,-100);
      }
      else
      {
      //swal("Success",response, "success");
      $('#add-form')[0].reset();
      location.reload();
      }
      }
      });
});
</script>
@endpush
@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
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
              <h3 class="box-title">Edit Customer/User {{$user->name}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
            <form class="form-horizontal" action="{!! route('customers.update'); !!}" method="post" enctype="multipart/form-data" id="add-form">
            @csrf
            <div class="box-body" >
            <div class="row">
              <!--for input-->
              <div class="col-md-8">
                <div class="form-group">
                  <label for="fname" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" autocomplete="off" value="{{$user->name}}" require >
                   <span class="text-red">
                      <strong class="name"></strong>
                    </span>
                  </div>
                </div>
                

                <div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}" autocomplete="off" require>
                    <span class="text-red">
                                <strong class="email"></strong>
                      </span>
                  </div>
                </div>
                
                <!-- <div class="form-group">
                  <label for="password" class="col-sm-3 control-label">Password</label>

                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" require>
                    <span class="text-red">
                                <strong class="password"></strong>
                      </span>
                  </div>
                </div> -->
               

               

                <div class="form-group">
                  <label for="mobile" class="col-sm-3 control-label">Mobile</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" value="{{$user->mobile}}" autocomplete="off" require>
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
                          
                          <input id="avatar" name="avatar-1" type="file">
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
                       <option value="Featured" @if($user->user_type=='Featured') selected='selected' @endif>Featured</option>
                       <option value="Daily Recommendation" @if($user->user_type=='Daily Recommendation') selected='selected' @endif>Daily Recommendation</option>
                       <option value="Normal" @if($user->user_type=='Normal') selected='selected' @endif>Normal</option>
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
                       <option value="Real" @if($user->user_identity=='Real') selected='selected' @endif>Real</option>
                       <option value="Fake" @if($user->user_identity=='Fake') selected='selected' @endif>Fake</option>
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
                       <option value="Self" @if($user->profile_created_by=='Self') selected='selected' @endif>Self</option>
                       <option value="Parents" @if($user->profile_created_by=='Parents') selected='selected' @endif>Parents</option>
                       <option value="Sibling" @if($user->profile_created_by=='Sibling') selected='selected' @endif>Sibling</option>
                       <option value="Relative" @if($user->profile_created_by=='Relative') selected='selected' @endif>Relative</option>
                       <option value="Friend" @if($user->profile_created_by=='Friend') selected='selected' @endif>Friend</option>
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
                       <option value="Male" @if($user->gender=='Male') selected='selected' @endif>Male</option>
                       <option value="Female" @if($user->gender=='Female') selected='selected' @endif>Female</option>
                    </select >  
                    <span class="text-red">
                                <strong class="gender"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="date_of_birth" class="col-sm-2 control-label">Date of birth</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="date_of_birth" name="date_of_birth"  data-inputmask="'alias': 'yyyy-mm-dd'" data-mask value="{{ $user->date_of_birth }}" autocomplete="off" require>
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
                       <option value="{{$row->country_name}}" @if($user->my_country==$row->country_name) selected='selected' @endif>{{$row->country_name}}</option>
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
                       <option value="{{$row->country_name}}" @if($user->my_country_choice==$row->country_name) selected='selected' @endif>{{$row->country_name}}</option>
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
                    <input type="text" class="form-control" id="my_city" name="my_city" placeholder="" value="{{ $user->my_city }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="my_city"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_choice_city" class="col-sm-2 control-label">My Choice City</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="my_choice_city" name="my_choice_city" placeholder="" value="{{ $user->my_choice_city }}" autocomplete="off" require>
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
                       <option value="Christianity" @if($user->religion=='Christianity') selected='selected' @endif>Christianity</option>
                       <option value="Islam-shia" @if($user->religion=='Islam-shia') selected='selected' @endif>Islam-shia</option>
                       <option value="Islam-sunnis" @if($user->religion=='Islam-sunnis') selected='selected' @endif>Islam-sunnis</option>
                       <option value="Islam-Brailvi" @if($user->religion=='Islam-Brailvi') selected='selected' @endif>Islam-Brailvi</option>
                       <option value="Islam-Deobandi" @if($user->religion=='Islam-Deobandi') selected='selected' @endif>Islam-Deobandi</option>
                       <option value="Islam-Wahabi" @if($user->religion=='Islam-Wahabi') selected='selected' @endif>Islam-Wahabi</option>
                       <option value="Islam-Abbasi" @if($user->religion=='Islam-Abbasi') selected='selected' @endif>Islam-Abbasi</option>
                       <option value="Qadyani" @if($user->religion=='Qadyani') selected='selected' @endif>Qadyani</option>
                       <option value="Ahmadi" @if($user->religion=='Ahmadi') selected='selected' @endif>Ahmadi</option>
                       <option value="Nonreligious" @if($user->religion=='Nonreligious') selected='selected' @endif>Nonreligious</option>
                       <option value="Hinduism" @if($user->religion=='Hinduism') selected='selected' @endif>Hinduism</option>
                       <option value="Chinese traditional religion" @if($user->religion=='Chinese traditional religion') selected='selected' @endif>Chinese traditional religion</option>
                       <option value="Buddhism" @if($user->religion=='Buddhism') selected='selected' @endif>Buddhism</option>
                       <option value="Primal-indigenous" @if($user->religion=='Primal-indigenous') selected='selected' @endif>Primal-indigenous</option>
                       <option value="African traditional and Diasporic" @if($user->religion=='African traditional and Diasporic') selected='selected' @endif>African traditional and Diasporic</option>
                       <option value="Sikhism" @if($user->religion=='Sikhism') selected='selected' @endif>Sikhism</option>
                       <option value="Juche" @if($user->religion=='Juche') selected='selected' @endif>Juche</option>
                       <option value="Spiritism" @if($user->religion=='Spiritism') selected='selected' @endif>Spiritism</option>
                       <option value="Judaism" @if($user->religion=='Judaism') selected='selected' @endif>Judaism</option>
                       <option value="Bahai" @if($user->religion=='Bahai') selected='selected' @endif>Bahai</option>
                       <option value="Jainism" @if($user->religion=='Jainism') selected='selected' @endif>Jainism</option>
                       <option value="Shinto" @if($user->religion=='Shinto') selected='selected' @endif>Shinto</option>
                       <option value="Cao Dai" @if($user->religion=='Cao Dai') selected='selected' @endif>Cao Dai</option>
                       <option value="Zoroastrianism" @if($user->religion=='Zoroastrianism') selected='selected' @endif>Zoroastrianism</option>
                       <option value="Tenrikyo" @if($user->religion=='Tenrikyo') selected='selected' @endif>Tenrikyo</option>
                       <option value="Neo-Paganism" @if($user->religion=='Neo-Paganism') selected='selected' @endif>Neo-Paganism</option>
                       <option value="Unitarian-Universalism" @if($user->religion=='Unitarian-Universalism') selected='selected' @endif>Unitarian-Universalism</option>
                    </select >  
                    <span class="text-red">
                                <strong class="religion"></strong>
                      </span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="mother_tongue" class="col-sm-2 control-label">Mother Tongue</label>
                  <div class="col-sm-6">
                    <select type="text" class="form-control" id="mother_tongue" name="mother_tongue" >
                       <option value="" >Choose Option</option>
                       <option value="Chinese" @if($user->mother_tongue=='Chinese') selected='selected' @endif>Chinese</option>
                       <option value="Spanish" @if($user->mother_tongue=='Spanish') selected='selected' @endif>Spanish</option>
                       <option value="English" @if($user->mother_tongue=='English') selected='selected' @endif>English</option>
                       <option value="Arabic" @if($user->mother_tongue=='Arabic') selected='selected' @endif>Arabic</option>
                       <option value="Portuguese" @if($user->mother_tongue=='Portuguese') selected='selected' @endif>Portuguese</option>
                       <option value="Russian" @if($user->mother_tongue=='Russian') selected='selected' @endif>Russian</option>
                       <option value="Japanese" @if($user->mother_tongue=='Japanese') selected='selected' @endif>Japanese</option>
                       <option value="Lahnda" @if($user->mother_tongue=='Lahnda') selected='selected' @endif>Lahnda</option>
                       <option value="Javanese" @if($user->mother_tongue=='Javanese') selected='selected' @endif>Javanese</option>
                       <option value="German" @if($user->mother_tongue=='German') selected='selected' @endif>German</option>
                       <option value="Korean" @if($user->mother_tongue=='Korean') selected='selected' @endif>Korean</option>
                       <option value="French" @if($user->mother_tongue=='French') selected='selected' @endif>French</option>
                       <option value="Vietnamese" @if($user->mother_tongue=='Vietnamese') selected='selected' @endif>Vietnamese</option>
                       <option value="Bengali" @if($user->mother_tongue=='Bengali') selected='selected' @endif>Bengali</option>
                       <option value="Hindi" @if($user->mother_tongue=='Hindi') selected='selected' @endif>Hindi</option>
                       <option value="Telugu" @if($user->mother_tongue=='Telugu') selected='selected' @endif>Telugu</option>
                       <option value="Marathi" @if($user->mother_tongue=='Marathi') selected='selected' @endif>Marathi</option>
                       <option value="Tamil" @if($user->mother_tongue=='Tamil') selected='selected' @endif>Tamil</option>
                       <option value="Gujarati" @if($user->mother_tongue=='Gujarati') selected='selected' @endif>Gujarati</option>
                       <option value="Maithili" @if($user->mother_tongue=='Maithili') selected='selected' @endif>Maithili</option>
                       <option value="Kannada" @if($user->mother_tongue=='Kannada') selected='selected' @endif>Kannada</option>
                       <option value="Urdu" @if($user->mother_tongue=='Urdu') selected='selected' @endif>Urdu</option>
                       <option value="Punjabi" @if($user->mother_tongue=='Punjabi') selected='selected' @endif>Punjabi</option>
                       <option value="Pashtu" @if($user->mother_tongue=='Pashtu') selected='selected' @endif>Pashtu</option>
                       <option value="Sindhi" @if($user->mother_tongue=='Sindhi') selected='selected' @endif>Sindhi</option>
                       <option value="Hinko" @if($user->mother_tongue=='Hinko') selected='selected' @endif>Hinko</option>
                       <option value="Balochi" @if($user->mother_tongue=='Balochi') selected='selected' @endif>Balochi</option>
                       <option value="Kashmiri" @if($user->mother_tongue=='Kashmiri') selected='selected' @endif>Kashmiri</option>
                       <option value="Balti" @if($user->mother_tongue=='Balti') selected='selected' @endif>Balti</option>
                    </select >  
                    <span class="text-red">
                                <strong class="mother_tongue"></strong>
                      </span>
                  </div>
                </div>                    
                
                <div class="form-group">
                  <label for="my_visa" class="col-sm-2 control-label">My Visa</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_visa" name="my_visa" value="Citizen" @if($user->my_visa=='Citizen') checked='checked' @endif style="margin-left: 12px;">Citizen
                    <input type="radio"  id="my_visa" name="my_visa" value="Permanent Resident" @if($user->my_visa=='Permanent Resident') checked='checked' @endif style="margin-left: 12px;">Permanent Resident
                    <input type="radio"  id="my_visa" name="my_visa" value="Work visa" @if($user->my_visa=='Work visa') checked='checked' @endif style="margin-left: 12px;">Work visa
                    <input type="radio"  id="my_visa" name="my_visa" value="Student visa" @if($user->my_visa=='Student visa') checked='checked' @endif style="margin-left: 12px;">Student visa 
                    <input type="radio"  id="my_visa" name="my_visa" value="Other" @if($user->my_visa=='Other') checked='checked' @endif style="margin-left: 12px;">Other
                    <br>
                    <span class="text-red">
                      <strong class="my_visa"></strong>
                    </span>
                  </div>
                </div>

                <?php 
                      
                      $my_choice_visa = explode(",",$user->my_choice_visa);
                      

                ?>

                <div class="form-group">
                  <label for="my_choice_visa" class="col-sm-2 control-label">My Choice Visa</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_visa" name="my_choice_visa[]" value="Citizen" @if(in_array('Citizen',$my_choice_visa)) checked='checked' @endif style="margin-left: 12px;">Citizen
                    <input type="checkbox"  id="my_choice_visa" name="my_choice_visa[]" value="Permanent Resident" @if(in_array("Permanent Resident",$my_choice_visa)) checked='checked' @endif style="margin-left: 12px;">Permanent Resident
                    <input type="checkbox"  id="my_choice_visa" name="my_choice_visa[]" value="Work visa" @if(in_array('Work visa',$my_choice_visa)) checked='checked' @endif style="margin-left: 12px;">Work visa
                    <input type="checkbox"  id="my_choice_visa" name="my_choice_visa[]" value="Student visa" @if(in_array('Student visa',$my_choice_visa)) checked='checked' @endif style="margin-left: 12px;">Student visa 
                    <input type="checkbox"  id="my_choice_visa" name="my_choice_visa[]" value="Other" @if(in_array('Other',$my_choice_visa)) checked='checked' @endif style="margin-left: 12px;">Other
                    <input type="checkbox"  id="my_choice_visa" name="my_choice_visa[]" value="Any" @if(in_array('Any',$my_choice_visa)) checked='checked' @endif style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_visa"></strong>
                    </span>
                  </div>
                </div>
                

                 <div class="form-group">
                  <label for="my_physique" class="col-sm-2 control-label">My Physique</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_physique" name="my_physique" value="Slim" @if($user->my_physique=='Slim') checked='checked' @endif style="margin-left: 12px;">Slim
                    <input type="radio"  id="my_physique" name="my_physique" value="Athletic" @if($user->my_physique=='Athletic') checked='checked' @endif  style="margin-left: 12px;">Athletic
                    <input type="radio"  id="my_physique" name="my_physique" value="Average" @if($user->my_physique=='Average') checked='checked' @endif style="margin-left: 12px;">Average
                    <input type="radio"  id="my_physique" name="my_physique" value="Few Extra Pounds" @if($user->my_physique=='Few Extra Pounds') checked='checked' @endif style="margin-left: 12px;">Few Extra Pounds
                    <input type="radio"  id="my_physique" name="my_physique" value="Ower Weight" @if($user->my_physique=='Ower Weight') checked='checked' @endif style="margin-left: 12px;">Ower Weight
                    <br>
                    <span class="text-red">
                      <strong class="my_physique"></strong>
                    </span>
                  </div>
                </div>

                <?php 
                      $my_choice_physique = explode(",",$user->my_choice_physique);
                ?>

                <div class="form-group">
                  <label for="my_choice_physique" class="col-sm-2 control-label">My Choice Physique</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_physique" name="my_choice_physique[]" value="Slim" @if(in_array('Slim',$my_choice_physique)) checked='checked' @endif style="margin-left: 12px;">Slim
                    <input type="checkbox"  id="my_choice_physique" name="my_choice_physique[]" value="Athletic" @if(in_array('Athletic',$my_choice_physique)) checked='checked' @endif style="margin-left: 12px;">Athletic
                    <input type="checkbox"  id="my_choice_physique" name="my_choice_physique[]" value="Average" @if(in_array('Average',$my_choice_physique)) checked='checked' @endif style="margin-left: 12px;">Average
                    <input type="checkbox"  id="my_choice_physique" name="my_choice_physique[]" value="Few Extra Pounds" @if(in_array('Few Extra Pounds',$my_choice_physique)) checked='checked' @endif style="margin-left: 12px;">Few Extra Pounds 
                    <input type="checkbox"  id="my_choice_physique" name="my_choice_physique[]" value="Ower Weight" @if(in_array('Ower Weight',$my_choice_physique)) checked='checked' @endif style="margin-left: 12px;">Ower Weight
                    <input type="checkbox"  id="my_choice_physique" name="my_choice_physique[]" value="Any" @if(in_array('Any',$my_choice_physique)) checked='checked' @endif style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_physique"></strong>
                    </span>
                  </div>
                </div>  

                 <div class="form-group">
                  <label for="my_complexion" class="col-sm-2 control-label">My Complexion</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_complexion" name="my_complexion" value="Very Fair"  @if($user->my_complexion=='Very Fair') checked='checked' @endif style="margin-left: 12px;">Very Fair
                    <input type="radio"  id="my_complexion" name="my_complexion" value="Light / Fair"  @if($user->my_complexion=='Light / Fair') checked='checked' @endif style="margin-left: 12px;">Light / Fair
                    <input type="radio"  id="my_complexion" name="my_complexion" value="Wheatish"  @if($user->my_complexion=='Wheatish') checked='checked' @endif style="margin-left: 12px;">Wheatish
                    <input type="radio"  id="my_complexion" name="my_complexion" value="Dark"  @if($user->my_complexion=='Dark') checked='checked' @endif style="margin-left: 12px;">Dark 
                    <br>
                    <span class="text-red">
                      <strong class="my_complexion"></strong>
                    </span>
                  </div>
                </div>

                <?php 
                      $my_choice_complexion = explode(",",$user->my_choice_complexion);
                ?>

                <div class="form-group">
                  <label for="my_choice_complexion" class="col-sm-2 control-label">My Choice Complexion</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_complexion" name="my_choice_complexion[]" value="Very Fair" @if(in_array('Very Fair',$my_choice_complexion)) checked='checked' @endif style="margin-left: 12px;">Very Fair
                    <input type="checkbox"  id="my_choice_complexion" name="my_choice_complexion[]" value="Light / Fair" @if(in_array('Light / Fair',$my_choice_complexion)) checked='checked' @endif style="margin-left: 12px;">Light / Fair
                    <input type="checkbox"  id="my_choice_complexion" name="my_choice_complexion[]" value="Wheatish" @if(in_array('Wheatish',$my_choice_complexion)) checked='checked' @endif style="margin-left: 12px;">Wheatish
                    <input type="checkbox"  id="my_choice_complexion" name="my_choice_complexion[]" value="Dark" @if(in_array('Dark',$my_choice_complexion)) checked='checked' @endif style="margin-left: 12px;">Dark 
                    <input type="checkbox"  id="my_choice_complexion" name="my_choice_complexion[]" value="Any" @if(in_array('Any',$my_choice_complexion)) checked='checked' @endif style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_complexion"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_hair_color" class="col-sm-2 control-label">My Hair Color</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_hair_color" name="my_hair_color" value="Black" @if($user->my_hair_color=='Black') checked='checked' @endif style="margin-left: 12px;">Black
                    <input type="radio"  id="my_hair_color" name="my_hair_color" value="Brown" @if($user->my_hair_color=='Brown') checked='checked' @endif style="margin-left: 12px;">Brown
                    <input type="radio"  id="my_hair_color" name="my_hair_color" value="Blonde" @if($user->my_hair_color=='Blonde') checked='checked' @endif style="margin-left: 12px;">Blonde
                    <input type="radio"  id="my_hair_color" name="my_hair_color" value="Red" @if($user->my_hair_color=='Red') checked='checked' @endif style="margin-left: 12px;">Red 
                    <input type="radio"  id="my_hair_color" name="my_hair_color" value="Gray" @if($user->my_hair_color=='Gray') checked='checked' @endif style="margin-left: 12px;">Gray 
                    <input type="radio"  id="my_hair_color" name="my_hair_color" value="Blad (Not Shaved)"  @if($user->my_hair_color=='Blad (Not Shaved)') checked='checked' @endif style="margin-left: 12px;">Blad (Not Shaved)
                    <br>
                    <span class="text-red">
                      <strong class="my_hair_color"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_choice_hair_color = explode(",",$user->my_choice_hair_color);
                ?>

                <div class="form-group">
                  <label for="my_choice_hair_color" class="col-sm-2 control-label">My Choice Hair Color</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Black" @if(in_array('Black',$my_choice_hair_color)) checked='checked' @endif style="margin-left: 12px;">Black
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Brown" @if(in_array('Brown',$my_choice_hair_color)) checked='checked' @endif style="margin-left: 12px;">Brown
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Blonde" @if(in_array('Blonde',$my_choice_hair_color)) checked='checked' @endif style="margin-left: 12px;">Blonde
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Red" @if(in_array('Red',$my_choice_hair_color)) checked='checked' @endif style="margin-left: 12px;">Red 
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Gray" @if(in_array('Gray',$my_choice_hair_color)) checked='checked' @endif style="margin-left: 12px;">Gray 
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Blade(Not Shaved)" @if(in_array('Blade(Not Shaved)',$my_choice_hair_color)) checked='checked' @endif style="margin-left: 12px;">Blade(Not Shaved) 
                    <input type="checkbox"  id="my_choice_hair_color" name="my_choice_hair_color[]" value="Any" @if(in_array('Any',$my_choice_hair_color)) checked='checked' @endif style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_hair_color"></strong>
                    </span>
                  </div>
                </div> 

               <div class="form-group">
                  <label for="my_eye_color" class="col-sm-2 control-label">My Eye Color</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_eye_color" name="my_eye_color" value="Black" @if($user->my_eye_color=='Black') checked='checked' @endif style="margin-left: 12px;">Black
                    <input type="radio"  id="my_eye_color" name="my_eye_color" value="Brown" @if($user->my_eye_color=='Brown') checked='checked' @endif style="margin-left: 12px;">Brown
                    <input type="radio"  id="my_eye_color" name="my_eye_color" value="Gray" @if($user->my_eye_color=='Gray') checked='checked' @endif style="margin-left: 12px;">Gray 
                    <input type="radio"  id="my_eye_color" name="my_eye_color" value="Blue" @if($user->my_eye_color=='Blue') checked='checked' @endif style="margin-left: 12px;">Blue
                    <input type="radio"  id="my_eye_color" name="my_eye_color" value="Green" @if($user->my_eye_color=='Green') checked='checked' @endif style="margin-left: 12px;">Green 
                    <input type="radio"  id="my_eye_color" name="my_eye_color" value="Hazel" @if($user->my_eye_color=='Hazel') checked='checked' @endif style="margin-left: 12px;">Hazel 
                    <br>
                    <span class="text-red">
                      <strong class="my_eye_color"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_choice_eye_color = explode(",",$user->my_choice_eye_color);

                ?>

                <div class="form-group">
                  <label for="my_choice_eye_color" class="col-sm-2 control-label">My Choice Eye Color</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Black" @if(in_array('Black',$my_choice_eye_color)) checked='checked' @endif style="margin-left: 12px;">Black
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Brown" @if(in_array('Brown',$my_choice_eye_color)) checked='checked' @endif style="margin-left: 12px;">Brown
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Gray" @if(in_array('Gray',$my_choice_eye_color)) checked='checked' @endif style="margin-left: 12px;">Gray 
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Blue" @if(in_array('Blue',$my_choice_eye_color)) checked='checked' @endif style="margin-left: 12px;">Blue
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Green" @if(in_array('Green',$my_choice_eye_color)) checked='checked' @endif style="margin-left: 12px;">Green 
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Hazel" @if(in_array('Hazel',$my_choice_eye_color)) checked='checked' @endif style="margin-left: 12px;">Hazel 
                    <input type="checkbox"  id="my_choice_eye_color" name="my_choice_eye_color[]" value="Any" @if(in_array('Any',$my_choice_eye_color)) checked='checked' @endif style="margin-left: 12px;">Any
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
                       <option value="4'5 Feet" @if($user->my_height=="4'5 Feet") selected='selected' @endif>4'5 Feet</option>
                       <option value="4'6 Feet" @if($user->my_height=="4'6 Feet") selected='selected' @endif>4'6 Feet</option>
                       <option value="4'7 Feet" @if($user->my_height=="4'7 Feet") selected='selected' @endif>4'7 Feet</option>
                       <option value="4'8 Feet" @if($user->my_height=="4'8 Feet") selected='selected' @endif>4'8 Feet</option>
                       <option value="4'9 Feet" @if($user->my_height=="4'9 Feet") selected='selected' @endif>4'9 Feet</option>
                       <option value="5 Feet" @if($user->my_height=='5 Feet') selected='selected' @endif>5 Feet</option>
                       <option value="5'1 Feet" @if($user->my_height=="5'1 Feet") selected='selected' @endif>5'1 Feet</option>
                       <option value="5'2 Feet" @if($user->my_height=="5'2 Feet") selected='selected' @endif>5'2 Feet</option>
                       <option value="5'3 Feet"  @if($user->my_height=="5'3 Feet") selected='selected' @endif>5'3 Feet</option>
                       <option value="5'4 Feet" @if($user->my_height=="5'4 Feet") selected='selected' @endif>5'4 Feet</option>
                       <option value="5'5 Feet" @if($user->my_height=="5'5 Feet") selected='selected' @endif>5'5 Feet</option>
                       <option value="5'6 Feet" @if($user->my_height=="5'6 Feet") selected='selected' @endif>5'6 Feet</option>
                       <option value="5'7 Feet" @if($user->my_height=="5'7 Feet") selected='selected' @endif>5'7 Feet</option>
                       <option value="5'8 Feet" @if($user->my_height=="5'8 Feet") selected='selected' @endif>5'8 Feet</option>
                       <option value="5'9 Feet" @if($user->my_height=="5'9 Feet") selected='selected' @endif>5'9 Feet</option>
                       <option value="6 Feet" @if($user->my_height=="6 Feet") selected='selected' @endif>6 Feet</option>
                       <option value="6'1 Feet" @if($user->my_height=="6'1 Feet") selected='selected' @endif>6'1 Feet</option>
                       <option value="6'2 Feet" @if($user->my_height=="6'2 Feet") selected='selected' @endif>6'2 Feet</option>
                       <option value="6'3 Feet" @if($user->my_height=="6'3 Feet") selected='selected' @endif>6'3 Feet</option>
                       <option value="6'4 Feet" @if($user->my_height=="6'4 Feet") selected='selected' @endif>6'4 Feet</option>
                       <option value="6'5 Feet" @if($user->my_height=="6'5 Feet") selected='selected' @endif>6'5 Feet</option>
                       <option value="6'6 Feet" @if($user->my_height=="6'6 Feet") selected='selected' @endif>6'6 Feet</option>
                       <option value="6'7 Feet" @if($user->my_height=="6'7 Feet") selected='selected' @endif>6'7 Feet</option>
                       <option value="6'8 Feet" @if($user->my_height=="6'8 Feet") selected='selected' @endif>6'8 Feet</option>
                       <option value="6'9 Feet" @if($user->my_height=="6'9 Feet") selected='selected' @endif>6'9 Feet</option>
                       <option value="7 Feet" @if($user->my_height=="7 Feet") selected='selected' @endif>7 Feet</option>
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
                      <option value="4'5 Feet" @if($user->my_choice_height_from=="4'5 Feet") selected='selected' @endif>4'5 Feet</option>
                       <option value="4'6 Feet" @if($user->my_choice_height_from=="4'6 Feet") selected='selected' @endif>4'6 Feet</option>
                       <option value="4'7 Feet" @if($user->my_choice_height_from=="4'7 Feet") selected='selected' @endif>4'7 Feet</option>
                       <option value="4'8 Feet" @if($user->my_choice_height_from=="4'8 Feet") selected='selected' @endif>4'8 Feet</option>
                       <option value="4'9 Feet" @if($user->my_choice_height_from=="4'9 Feet") selected='selected' @endif>4'9 Feet</option>
                       <option value="5 Feet" @if($user->my_choice_height_from=='5 Feet') selected='selected' @endif>5 Feet</option>
                       <option value="5'1 Feet" @if($user->my_choice_height_from=="5'1 Feet") selected='selected' @endif>5'1 Feet</option>
                       <option value="5'2 Feet" @if($user->my_choice_height_from=="5'2 Feet") selected='selected' @endif>5'2 Feet</option>
                       <option value="5'3 Feet"  @if($user->my_choice_height_from=="5'3 Feet") selected='selected' @endif>5'3 Feet</option>
                       <option value="5'4 Feet" @if($user->my_choice_height_from=="5'4 Feet") selected='selected' @endif>5'4 Feet</option>
                       <option value="5'5 Feet" @if($user->my_choice_height_from=="5'5 Feet") selected='selected' @endif>5'5 Feet</option>
                       <option value="5'6 Feet" @if($user->my_choice_height_from=="5'6 Feet") selected='selected' @endif>5'6 Feet</option>
                       <option value="5'7 Feet" @if($user->my_choice_height_from=="5'7 Feet") selected='selected' @endif>5'7 Feet</option>
                       <option value="5'8 Feet" @if($user->my_choice_height_from=="5'8 Feet") selected='selected' @endif>5'8 Feet</option>
                       <option value="5'9 Feet" @if($user->my_choice_height_from=="5'9 Feet") selected='selected' @endif>5'9 Feet</option>
                       <option value="6 Feet" @if($user->my_choice_height_from=="6 Feet") selected='selected' @endif>6 Feet</option>
                       <option value="6'1 Feet" @if($user->my_choice_height_from=="6'1 Feet") selected='selected' @endif>6'1 Feet</option>
                       <option value="6'2 Feet" @if($user->my_choice_height_from=="6'2 Feet") selected='selected' @endif>6'2 Feet</option>
                       <option value="6'3 Feet" @if($user->my_choice_height_from=="6'3 Feet") selected='selected' @endif>6'3 Feet</option>
                       <option value="6'4 Feet" @if($user->my_choice_height_from=="6'4 Feet") selected='selected' @endif>6'4 Feet</option>
                       <option value="6'5 Feet" @if($user->my_choice_height_from=="6'5 Feet") selected='selected' @endif>6'5 Feet</option>
                       <option value="6'6 Feet" @if($user->my_choice_height_from=="6'6 Feet") selected='selected' @endif>6'6 Feet</option>
                       <option value="6'7 Feet" @if($user->my_choice_height_from=="6'7 Feet") selected='selected' @endif>6'7 Feet</option>
                       <option value="6'8 Feet" @if($user->my_choice_height_from=="6'8 Feet") selected='selected' @endif>6'8 Feet</option>
                       <option value="6'9 Feet" @if($user->my_choice_height_from=="6'9 Feet") selected='selected' @endif>6'9 Feet</option>
                       <option value="7 Feet" @if($user->my_choice_height_from=="7 Feet") selected='selected' @endif>7 Feet</option>
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
                      <option value="4'5 Feet" @if($user->my_choice_height_to=="4'5 Feet") selected='selected' @endif>4'5 Feet</option>
                       <option value="4'6 Feet" @if($user->my_choice_height_to=="4'6 Feet") selected='selected' @endif>4'6 Feet</option>
                       <option value="4'7 Feet" @if($user->my_choice_height_to=="4'7 Feet") selected='selected' @endif>4'7 Feet</option>
                       <option value="4'8 Feet" @if($user->my_choice_height_to=="4'8 Feet") selected='selected' @endif>4'8 Feet</option>
                       <option value="4'9 Feet" @if($user->my_choice_height_to=="4'9 Feet") selected='selected' @endif>4'9 Feet</option>
                       <option value="5 Feet" @if($user->my_choice_height_to=='5 Feet') selected='selected' @endif>5 Feet</option>
                       <option value="5'1 Feet" @if($user->my_choice_height_to=="5'1 Feet") selected='selected' @endif>5'1 Feet</option>
                       <option value="5'2 Feet" @if($user->my_choice_height_to=="5'2 Feet") selected='selected' @endif>5'2 Feet</option>
                       <option value="5'3 Feet"  @if($user->my_choice_height_to=="5'3 Feet") selected='selected' @endif>5'3 Feet</option>
                       <option value="5'4 Feet" @if($user->my_choice_height_to=="5'4 Feet") selected='selected' @endif>5'4 Feet</option>
                       <option value="5'5 Feet" @if($user->my_choice_height_to=="5'5 Feet") selected='selected' @endif>5'5 Feet</option>
                       <option value="5'6 Feet" @if($user->my_choice_height_to=="5'6 Feet") selected='selected' @endif>5'6 Feet</option>
                       <option value="5'7 Feet" @if($user->my_choice_height_to=="5'7 Feet") selected='selected' @endif>5'7 Feet</option>
                       <option value="5'8 Feet" @if($user->my_choice_height_to=="5'8 Feet") selected='selected' @endif>5'8 Feet</option>
                       <option value="5'9 Feet" @if($user->my_choice_height_to=="5'9 Feet") selected='selected' @endif>5'9 Feet</option>
                       <option value="6 Feet" @if($user->my_choice_height_to=="6 Feet") selected='selected' @endif>6 Feet</option>
                       <option value="6'1 Feet" @if($user->my_choice_height_to=="6'1 Feet") selected='selected' @endif>6'1 Feet</option>
                       <option value="6'2 Feet" @if($user->my_choice_height_to=="6'2 Feet") selected='selected' @endif>6'2 Feet</option>
                       <option value="6'3 Feet" @if($user->my_choice_height_to=="6'3 Feet") selected='selected' @endif>6'3 Feet</option>
                       <option value="6'4 Feet" @if($user->my_choice_height_to=="6'4 Feet") selected='selected' @endif>6'4 Feet</option>
                       <option value="6'5 Feet" @if($user->my_choice_height_to=="6'5 Feet") selected='selected' @endif>6'5 Feet</option>
                       <option value="6'6 Feet" @if($user->my_choice_height_to=="6'6 Feet") selected='selected' @endif>6'6 Feet</option>
                       <option value="6'7 Feet" @if($user->my_choice_height_to=="6'7 Feet") selected='selected' @endif>6'7 Feet</option>
                       <option value="6'8 Feet" @if($user->my_choice_height_to=="6'8 Feet") selected='selected' @endif>6'8 Feet</option>
                       <option value="6'9 Feet" @if($user->my_choice_height_to=="6'9 Feet") selected='selected' @endif>6'9 Feet</option>
                       <option value="7 Feet" @if($user->my_choice_height_to=="7 Feet") selected='selected' @endif>7 Feet</option>
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
                       <option value="{{$i}} Years" @if($user->my_choice_age_from==$i." Years") selected='selected' @endif>{{$i}} Years</option>
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
                       <option value="{{$i}} Years" @if($user->my_choice_age_to==$i." Years") selected='selected' @endif>{{$i}} Years</option>
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
                       <option value="Doctorate Degree (Ph.D)" @if($user->education=="Years") selected='selected' @endif>Doctorate Degree (Ph.D)</option>
                       <option value="Doctor (Medical)" @if($user->education=="Doctor (Medical)") selected='selected' @endif>Doctor (Medical)</option>
                       <option value="Doctor (Dental)" @if($user->education=="Doctor (Dental)") selected='selected' @endif>Doctor (Dental)</option>
                       <option value="Engineering" @if($user->education=="Engineering") selected='selected' @endif>Engineering</option>
                       <option value="Master\'s Degree" @if($user->education=="Master\'s Degree") selected='selected' @endif>Master\'s Degree</option>
                       <option value="Bachelor\'s Degree" @if($user->education=="Bachelor\'s Degree") selected='selected' @endif>Bachelor\'s Degree</option>
                       <option value="College Graduate" @if($user->education=="College Graduate") selected='selected' @endif>College Graduate</option>
                       <option value="Associate\'s Degree" @if($user->education=="Associate\'s Degree") selected='selected' @endif>Associate\'s Degree</option>
                       <option value="Diploma" @if($user->education=="Diploma") selected='selected' @endif>Diploma</option>
                       <option value="High school" @if($user->education=="High school") selected='selected' @endif>High school</option>
                       <option value="Intermediate" @if($user->education=="Intermediate") selected='selected' @endif>Intermediate</option>
                       <option value="A-Level" @if($user->education=="A-Level") selected='selected' @endif>A-Level</option>
                       <option value="Matriculate" @if($user->education=="Matriculate") selected='selected' @endif>Matriculate</option>
                       <option value="O-Level" @if($user->education=="O-Level") selected='selected' @endif>O-Level</option>
                       <option value="Middle School" @if($user->education=="Middle School") selected='selected' @endif>Middle School</option>
                       <option value="Primary School" @if($user->education=="Primary School") selected='selected' @endif>Primary School</option>
                       <option value="Never Been to School" @if($user->education=="Never Been to School") selected='selected' @endif>Never Been to School</option>
                       <option value="other" @if($user->education=="other") selected='selected' @endif>other</option>
                       <option value="Religious Education" @if($user->education=="Religious Education") selected='selected' @endif>Religious Education</option>
                       <option value="Professional Certificate" @if($user->education=="Professional Certificate") selected='selected' @endif>Professional Certificate</option>
                       <option value="Master of philosophy ( M.Phil)" @if($user->education=="Master of philosophy ( M.Phil)") selected='selected' @endif>Master of philosophy ( M.Phil)</option>
                       
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
                       <option value="Administrative services" @if($user->education_field=="Administrative services") selected='selected' @endif>Administrative services</option>
                       <option value="Adervertising / Marketing" @if($user->education_field=="Adervertising / Marketing") selected='selected' @endif>Adervertising / Marketing</option>
                       <option value="Agriculture" @if($user->education_field=="Agriculture") selected='selected' @endif>Agriculture</option>
                       <option value="Architecture" @if($user->education_field=="Architecture") selected='selected' @endif>Architecture</option>
                       <option value="Armed Forces" @if($user->education_field=="Armed Forces") selected='selected' @endif>Armed Forces</option>
                       <option value="Arts" @if($user->education_field=="Arts") selected='selected' @endif>Arts</option>
                       <option value="Biology and Biomedical Sciences" @if($user->education_field=="Biology and Biomedical Sciences") selected='selected' @endif>Biology and Biomedical Sciences</option>
                       <option value="Business" @if($user->education_field=="Business") selected='selected' @endif>Business</option>
                       <option value="Commerce" @if($user->education_field=="Commerce") selected='selected' @endif>Commerce</option>
                       <option value="Communication and Journalism" @if($user->education_field=="Communication and Journalism") selected='selected' @endif>Communication and Journalism</option>
                       <option value="Computer Science" @if($user->education_field=="Computer Science") selected='selected' @endif>Computer Science</option>
                       <option value="Computers / IT" @if($user->education_field=="Computers / IT") selected='selected' @endif>Computers / IT</option>
                       <option value="Cosmetology" @if($user->education_field=="Cosmetology") selected='selected' @endif>Cosmetology</option>
                       <option value="Culinary Arts and Personal Services" @if($user->education_field=="Culinary Arts and Personal Services") selected='selected' @endif>Culinary Arts and Personal Services</option>
                       <option value="education_field" @if($user->education_field=="education_field") selected='selected' @endif>education_field</option>
                       <option value="Engineering and Technology" @if($user->education_field=="Engineering and Technology") selected='selected' @endif>Engineering and Technology</option>
                       <option value="Fashion" @if($user->education_field=="Fashion") selected='selected' @endif>Fashion</option>
                       <option value="Fine Arts" @if($user->education_field=="Fine Arts") selected='selected' @endif>Fine Arts</option>
                       <option value="Food Safty and quality" @if($user->education_field=="Food Safty and quality") selected='selected' @endif>Food Safty and quality</option>
                       <option value="Forestry" @if($user->education_field=="Forestry") selected='selected' @endif>Forestry</option>
                       <option value="HR" @if($user->education_field=="HR") selected='selected' @endif>HR</option>
                       <option value="Health Sciences" @if($user->education_field=="Health Sciences") selected='selected' @endif>Health Sciences</option>
                       <option value="Homeopathic" @if($user->education_field=="Homeopathic") selected='selected' @endif>Homeopathic</option>
                       <option value="Law" @if($user->education_field=="Law") selected='selected' @endif>Law</option>
                       <option value="Legal" @if($user->education_field=="Legal") selected='selected' @endif>Legal</option>
                       <option value="Liberal Arts and Humanities" @if($user->education_field=="Liberal Arts and Humanities") selected='selected' @endif>Liberal Arts and Humanities</option>
                       <option value="Management" @if($user->education_field=="Management") selected='selected' @endif>Management</option>
                       <option value="Mechanic and Repair Technologies" @if($user->education_field=="Mechanic and Repair Technologies") selected='selected' @endif>Mechanic and Repair Technologies</option>
                       <option value="Medical and health professional" @if($user->education_field=="Medical and health professional") selected='selected' @endif>Medical and health professional</option>
                       <option value="Medicine" @if($user->education_field=="Medicine") selected='selected' @endif>Medicine</option>
                       <option value="Music" @if($user->education_field=="Music") selected='selected' @endif>Music</option>
                       <option value="Nursing" @if($user->education_field=="Nursing") selected='selected' @endif>Nursing</option>
                       <option value="Office Administration" @if($user->education_field=="Office Administration") selected='selected' @endif>Office Administration</option>
                       <option value="other / General" @if($user->education_field=="other / General") selected='selected' @endif>other / General</option>
                       <option value="Physical Sciences" @if($user->education_field=="Physical Sciences") selected='selected' @endif>Physical Sciences</option>
                       <option value="Psychology" @if($user->education_field=="Psychology") selected='selected' @endif>Psychology</option>
                       <option value="Real Estate" @if($user->education_field=="Real Estate") selected='selected' @endif>Real Estate</option>
                       <option value="Religious Studies" @if($user->education_field=="Religious Studies") selected='selected' @endif>Religious Studies</option>
                       <option value="Science" @if($user->education_field=="Science") selected='selected' @endif>Science</option>
                       <option value="Social work" @if($user->education_field=="Social work") selected='selected' @endif>Social work</option>
                       <option value="Special education_field" @if($user->education_field=="Special Education") selected='selected' @endif>Special Education</option>
                       <option value="Theatre Arts" @if($user->education_field=="Theatre Arts") selected='selected' @endif>Theatre Arts</option>
                       <option value="Transpotation and Distribution" @if($user->education_field=="Transpotation and Distribution") selected='selected' @endif>Transpotation and Distribution</option>
                       <option value="Travel and Tourism" @if($user->education_field=="Travel and Tourism") selected='selected' @endif>Travel and Tourism</option>
                       <option value="Veterinary Services" @if($user->education_field=="Veterinary Services") selected='selected' @endif>Veterinary Services</option>
                       <option value="Visual and Performing Arts" @if($user->education_field=="Visual and Performing Arts") selected='selected' @endif>Visual and Performing Arts</option>
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
                       <option value="{{$i}}" @if($user->education_field_year==$i) selected='selected' @endif>{{$i}}</option>
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
                       <option value="Accounting / Auditing"  @if($user->my_occupation=="Accounting / Auditing") selected='selected' @endif>Accounting / Auditing</option>
                       <option value="Administrative"  @if($user->my_occupation=="Administrative") selected='selected' @endif>Administrative</option>
                       <option value="Advertisign / Marketing"  @if($user->my_occupation=="Advertisign / Marketing") selected='selected' @endif>Advertisign / Marketing</option>
                       <option value="Agriculture / Forestry"  @if($user->my_occupation=="Agriculture / Forestry") selected='selected' @endif>Agriculture / Forestry</option>
                       <option value="Architectural Services"  @if($user->my_occupation=="Architectural Services") selected='selected' @endif>Architectural Services</option>
                       <option value="Armed Forces / Military"  @if($user->my_occupation=="Armed Forces / Military") selected='selected' @endif>Armed Forces / Military</option>
                       <option value="Arts / Entertainment / Media"  @if($user->my_occupation=="Arts / Entertainment / Media") selected='selected' @endif>Arts / Entertainment / Media</option>
                       <option value="Automotive / Motor Vehicle / Parts"  @if($user->my_occupation=="Automotive / Motor Vehicle / Parts") selected='selected' @endif>Automotive / Motor Vehicle / Parts</option>
                       <option value="Aviation / Aerospace"  @if($user->my_occupation=="Aviation / Aerospace") selected='selected' @endif>Aviation / Aerospace</option>
                       <option value="Banking"  @if($user->my_occupation=="Banking") selected='selected' @endif>Banking</option>
                       <option value="Biotechnology / Pharmaceutical"  @if($user->my_occupation=="Biotechnology / Pharmaceutical") selected='selected' @endif>Biotechnology / Pharmaceutical</option>
                       <option value="Building and Ground Maintenance"  @if($user->my_occupation=="Building and Ground Maintenance") selected='selected' @endif>Building and Ground Maintenance</option>
                       <option value="Clerical"  @if($user->my_occupation=="Clerical") selected='selected' @endif>Clerical</option>
                       <option value="Computer , Hardware"  @if($user->my_occupation=="Computer , Hardware") selected='selected' @endif>Computer , Hardware</option>
                       <option value="Computer , Software"  @if($user->my_occupation=="Computer , Software") selected='selected' @endif>Computer , Software</option>
                       <option value="Construction / Labor"  @if($user->my_occupation=="Construction / Labor") selected='selected' @endif>Construction / Labor</option>
                       <option value="Consulting Services"  @if($user->my_occupation=="Consulting Services") selected='selected' @endif>Consulting Services</option>
                       <option value="Engineering"  @if($user->my_occupation=="Engineering") selected='selected' @endif>Engineering</option>
                       <option value="Executive / Management"  @if($user->my_occupation=="Executive / Management") selected='selected' @endif>Executive / Management</option>
                       <option value="Finance / Economics"  @if($user->my_occupation=="Finance / Economics") selected='selected' @endif>Finance / Economics</option>
                       <option value="Financial services"  @if($user->my_occupation=="Financial services") selected='selected' @endif>Financial services</option>
                       <option value="Government Employee"  @if($user->my_occupation=="Government Employee") selected='selected' @endif>Government Employee</option>
                       <option value="Healthcare - Medical Practitioners"  @if($user->my_occupation=="Healthcare - Medical Practitioners") selected='selected' @endif>Healthcare - Medical Practitioners</option>
                       <option value="Healthcare - Dental Practitioners"  @if($user->my_occupation=="Healthcare - Dental Practitioners") selected='selected' @endif>Healthcare - Dental Practitioners</option>
                       <option value="Healthcare - Para Medical / Nursing"  @if($user->my_occupation=="Healthcare - Para Medical / Nursing") selected='selected' @endif>Healthcare - Para Medical / Nursing</option>
                       <option value="Healthcare - Radiology / Imaging"  @if($user->my_occupation=="Healthcare - Radiology / Imaging") selected='selected' @endif>Healthcare - Radiology / Imaging</option>
                       <option value="Information Technology"  @if($user->my_occupation=="Information Technology") selected='selected' @endif>Information Technology</option>
                       <option value="Installation / Maintenance / Repair"  @if($user->my_occupation=="Installation / Maintenance / Repair") selected='selected' @endif>Installation / Maintenance / Repair</option>
                       <option value="Insurance"  @if($user->my_occupation=="Insurance") selected='selected' @endif>Insurance</option>
                       <option value="Internet / E-Commerce"  @if($user->my_occupation=="Internet / E-Commerce") selected='selected' @endif>Internet / E-Commerce</option>
                       <option value="Law Enforcement / Security"  @if($user->my_occupation=="Law Enforcement / Security") selected='selected' @endif>Law Enforcement / Security</option>
                       <option value="Legal"  @if($user->my_occupation=="Legal") selected='selected' @endif>Legal</option>
                       <option value="Manufacturing / production"  @if($user->my_occupation=="Manufacturing / production") selected='selected' @endif>Manufacturing / production</option>
                       <option value="Publishing / Printing"  @if($user->my_occupation=="Publishing / Printing") selected='selected' @endif>Publishing / Printing</option>
                       <option value="Real Estate / Mortgage"  @if($user->my_occupation=="Real Estate / Mortgage") selected='selected' @endif>Real Estate / Mortgage</option>
                       <option value="Recruiting / Human Resource"  @if($user->my_occupation=="Recruiting / Human Resource") selected='selected' @endif>Recruiting / Human Resource</option>
                       <option value="Restaurant / Food Services"  @if($user->my_occupation=="Restaurant / Food Services") selected='selected' @endif>Restaurant / Food Services</option>
                       <option value="Retail / Wholesale"  @if($user->my_occupation=="Retail / Wholesale") selected='selected' @endif>Retail / Wholesale</option>
                       <option value="Sales"  @if($user->my_occupation=="Sales") selected='selected' @endif>Sales</option>
                       <option value="Sales and Marketing"  @if($user->my_occupation=="Sales and Marketing") selected='selected' @endif>Sales and Marketing</option>
                       <option value="Self Employed"  @if($user->my_occupation=="Self Employed") selected='selected' @endif>Self Employed</option>
                       <option value="Sports and Recreation"  @if($user->my_occupation=="Sports and Recreation") selected='selected' @endif>Sports and Recreation</option>
                       <option value="Student"  @if($user->my_occupation=="Student") selected='selected' @endif>Student</option>
                       <option value="Teacher / professor / Education"  @if($user->my_occupation=="Teacher / professor / Education") selected='selected' @endif>Teacher / professor / Education</option>
                       <option value="Telecommunications"  @if($user->my_occupation=="Telecommunications") selected='selected' @endif>Telecommunications</option>
                       <option value="Tourism / Hospitality"  @if($user->my_occupation=="Tourism / Hospitality") selected='selected' @endif>Tourism / Hospitality</option>
                       <option value="Transpotation"  @if($user->my_occupation=="Transpotation") selected='selected' @endif>Transpotation</option>
                       <option value="Unemployed"  @if($user->my_occupation=="Unemployed") selected='selected' @endif>Unemployed</option>
                       <option value="Retired"  @if($user->my_occupation=="Retired") selected='selected' @endif>Retired</option>
                       <option value="Not working"  @if($user->my_occupation=="Not working") selected='selected' @endif>Not working</option>
                       <option value="Other"  @if($user->my_occupation=="Other") selected='selected' @endif>Other</option>
                       <option value="Healthcare- Other"  @if($user->my_occupation=="Healthcare- Other") selected='selected' @endif>Healthcare- Other</option>
                       
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
                        <option value="Accounting / Auditing"  @if($user->my_choice_occupation=="Accounting / Auditing") selected='selected' @endif>Accounting / Auditing</option>
                       <option value="Administrative"  @if($user->my_choice_occupation=="Administrative") selected='selected' @endif>Administrative</option>
                       <option value="Advertisign / Marketing"  @if($user->my_choice_occupation=="Advertisign / Marketing") selected='selected' @endif>Advertisign / Marketing</option>
                       <option value="Agriculture / Forestry"  @if($user->my_choice_occupation=="Agriculture / Forestry") selected='selected' @endif>Agriculture / Forestry</option>
                       <option value="Architectural Services"  @if($user->my_choice_occupation=="Architectural Services") selected='selected' @endif>Architectural Services</option>
                       <option value="Armed Forces / Military"  @if($user->my_choice_occupation=="Armed Forces / Military") selected='selected' @endif>Armed Forces / Military</option>
                       <option value="Arts / Entertainment / Media"  @if($user->my_choice_occupation=="Arts / Entertainment / Media") selected='selected' @endif>Arts / Entertainment / Media</option>
                       <option value="Automotive / Motor Vehicle / Parts"  @if($user->my_choice_occupation=="Automotive / Motor Vehicle / Parts") selected='selected' @endif>Automotive / Motor Vehicle / Parts</option>
                       <option value="Aviation / Aerospace"  @if($user->my_choice_occupation=="Aviation / Aerospace") selected='selected' @endif>Aviation / Aerospace</option>
                       <option value="Banking"  @if($user->my_choice_occupation=="Banking") selected='selected' @endif>Banking</option>
                       <option value="Biotechnology / Pharmaceutical"  @if($user->my_choice_occupation=="Biotechnology / Pharmaceutical") selected='selected' @endif>Biotechnology / Pharmaceutical</option>
                       <option value="Building and Ground Maintenance"  @if($user->my_choice_occupation=="Building and Ground Maintenance") selected='selected' @endif>Building and Ground Maintenance</option>
                       <option value="Clerical"  @if($user->my_choice_occupation=="Clerical") selected='selected' @endif>Clerical</option>
                       <option value="Computer , Hardware"  @if($user->my_choice_occupation=="Computer , Hardware") selected='selected' @endif>Computer , Hardware</option>
                       <option value="Computer , Software"  @if($user->my_choice_occupation=="Computer , Software") selected='selected' @endif>Computer , Software</option>
                       <option value="Construction / Labor"  @if($user->my_choice_occupation=="Construction / Labor") selected='selected' @endif>Construction / Labor</option>
                       <option value="Consulting Services"  @if($user->my_choice_occupation=="Consulting Services") selected='selected' @endif>Consulting Services</option>
                       <option value="Engineering"  @if($user->my_choice_occupation=="Engineering") selected='selected' @endif>Engineering</option>
                       <option value="Executive / Management"  @if($user->my_choice_occupation=="Executive / Management") selected='selected' @endif>Executive / Management</option>
                       <option value="Finance / Economics"  @if($user->my_choice_occupation=="Finance / Economics") selected='selected' @endif>Finance / Economics</option>
                       <option value="Financial services"  @if($user->my_choice_occupation=="Financial services") selected='selected' @endif>Financial services</option>
                       <option value="Government Employee"  @if($user->my_choice_occupation=="Government Employee") selected='selected' @endif>Government Employee</option>
                       <option value="Healthcare - Medical Practitioners"  @if($user->my_choice_occupation=="Healthcare - Medical Practitioners") selected='selected' @endif>Healthcare - Medical Practitioners</option>
                       <option value="Healthcare - Dental Practitioners"  @if($user->my_choice_occupation=="Healthcare - Dental Practitioners") selected='selected' @endif>Healthcare - Dental Practitioners</option>
                       <option value="Healthcare - Para Medical / Nursing"  @if($user->my_choice_occupation=="Healthcare - Para Medical / Nursing") selected='selected' @endif>Healthcare - Para Medical / Nursing</option>
                       <option value="Healthcare - Radiology / Imaging"  @if($user->my_choice_occupation=="Healthcare - Radiology / Imaging") selected='selected' @endif>Healthcare - Radiology / Imaging</option>
                       <option value="Information Technology"  @if($user->my_choice_occupation=="Information Technology") selected='selected' @endif>Information Technology</option>
                       <option value="Installation / Maintenance / Repair"  @if($user->my_choice_occupation=="Installation / Maintenance / Repair") selected='selected' @endif>Installation / Maintenance / Repair</option>
                       <option value="Insurance"  @if($user->my_choice_occupation=="Insurance") selected='selected' @endif>Insurance</option>
                       <option value="Internet / E-Commerce"  @if($user->my_choice_occupation=="Internet / E-Commerce") selected='selected' @endif>Internet / E-Commerce</option>
                       <option value="Law Enforcement / Security"  @if($user->my_choice_occupation=="Law Enforcement / Security") selected='selected' @endif>Law Enforcement / Security</option>
                       <option value="Legal"  @if($user->my_choice_occupation=="Legal") selected='selected' @endif>Legal</option>
                       <option value="Manufacturing / production"  @if($user->my_choice_occupation=="Manufacturing / production") selected='selected' @endif>Manufacturing / production</option>
                       <option value="Publishing / Printing"  @if($user->my_choice_occupation=="Publishing / Printing") selected='selected' @endif>Publishing / Printing</option>
                       <option value="Real Estate / Mortgage"  @if($user->my_choice_occupation=="Real Estate / Mortgage") selected='selected' @endif>Real Estate / Mortgage</option>
                       <option value="Recruiting / Human Resource"  @if($user->my_choice_occupation=="Recruiting / Human Resource") selected='selected' @endif>Recruiting / Human Resource</option>
                       <option value="Restaurant / Food Services"  @if($user->my_choice_occupation=="Restaurant / Food Services") selected='selected' @endif>Restaurant / Food Services</option>
                       <option value="Retail / Wholesale"  @if($user->my_choice_occupation=="Retail / Wholesale") selected='selected' @endif>Retail / Wholesale</option>
                       <option value="Sales"  @if($user->my_choice_occupation=="Sales") selected='selected' @endif>Sales</option>
                       <option value="Sales and Marketing"  @if($user->my_choice_occupation=="Sales and Marketing") selected='selected' @endif>Sales and Marketing</option>
                       <option value="Self Employed"  @if($user->my_choice_occupation=="Self Employed") selected='selected' @endif>Self Employed</option>
                       <option value="Sports and Recreation"  @if($user->my_choice_occupation=="Sports and Recreation") selected='selected' @endif>Sports and Recreation</option>
                       <option value="Student"  @if($user->my_choice_occupation=="Student") selected='selected' @endif>Student</option>
                       <option value="Teacher / professor / Education"  @if($user->my_choice_occupation=="Teacher / professor / Education") selected='selected' @endif>Teacher / professor / Education</option>
                       <option value="Telecommunications"  @if($user->my_choice_occupation=="Telecommunications") selected='selected' @endif>Telecommunications</option>
                       <option value="Tourism / Hospitality"  @if($user->my_choice_occupation=="Tourism / Hospitality") selected='selected' @endif>Tourism / Hospitality</option>
                       <option value="Transpotation"  @if($user->my_choice_occupation=="Transpotation") selected='selected' @endif>Transpotation</option>
                       <option value="Unemployed"  @if($user->my_choice_occupation=="Unemployed") selected='selected' @endif>Unemployed</option>
                       <option value="Retired"  @if($user->my_choice_occupation=="Retired") selected='selected' @endif>Retired</option>
                       <option value="Not working"  @if($user->my_choice_occupation=="Not working") selected='selected' @endif>Not working</option>
                       <option value="Other"  @if($user->my_choice_occupation=="Other") selected='selected' @endif>Other</option>
                       <option value="Healthcare- Other"  @if($user->my_choice_occupation=="Healthcare- Other") selected='selected' @endif>Healthcare- Other</option>
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
                       <option value="Less Than 25,000" @if($user->income_level=="Less Than 25,000") selected='selected' @endif>Less Than 25,000</option>
                       <option value="25,000 to 50,000" @if($user->income_level=="25,000 to 50,000") selected='selected' @endif>25,000 to 50,000</option>
                       <option value="50,000 to 75,000" @if($user->income_level=="50,000 to 75,000") selected='selected' @endif>50,000 to 75,000</option>
                       <option value="75,000 to 100,000" @if($user->income_level=="75,000 to 100,000") selected='selected' @endif>75,000 to 100,000</option>
                       <option value="100,000 to 125,000" @if($user->income_level=="100,000 to 125,000") selected='selected' @endif>100,000 to 125,000</option>
                       <option value="150,000 to 200,000" @if($user->income_level=="150,000 to 200,000") selected='selected' @endif>150,000 to 200,000</option>
                       <option value="200,000+" @if($user->income_level=="200,000+") selected='selected' @endif>200,000+</option>
                       <option value="Don\'t want to specify" @if($user->income_level=="Don\'t want to specify") selected='selected' @endif>Don\'t want to specify</option>
                    </select >  
                    <span class="text-red">
                                <strong class="income_level"></strong>
                      </span>
                  </div>
                </div>
                 
                 <div class="form-group">
                  <label for="caste" class="col-sm-2 control-label">Caste</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="caste" name="caste" placeholder="" value="{{ $user->caste }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="caste"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_economy" class="col-sm-2 control-label">My Economy</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_economy" name="my_economy" value="Struggling" @if($user->my_economy=='Struggling') checked='checked' @endif style="margin-left: 12px;">Struggling
                    <input type="radio"  id="my_economy" name="my_economy" value="Family Supported" @if($user->my_economy=='Family Supported') checked='checked' @endif style="margin-left: 12px;">Family Supported
                    <input type="radio"  id="my_economy" name="my_economy" value="Independent" @if($user->my_economy=='Independent') checked='checked' @endif style="margin-left: 12px;">Independent 
                    <input type="radio"  id="my_economy" name="my_economy" value="Settled" @if($user->my_economy=='Settled') checked='checked' @endif style="margin-left: 12px;">Settled
                    <input type="radio"  id="my_economy" name="my_economy" value="Well Settled" @if($user->my_economy=='Well Settled') checked='checked' @endif style="margin-left: 12px;">Well Settled
                    <br>
                    <span class="text-red">
                      <strong class="my_economy"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_choice_economy = explode(",",$user->my_choice_economy);
                      
                ?>

                <div class="form-group">
                  <label for="my_choice_economy" class="col-sm-2 control-label">My Choice Economy</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_economy" name="my_choice_economy[]" value="Struggling" @if(in_array('Struggling',$my_choice_economy)) checked='checked' @endif style="margin-left: 5px;">Struggling
                    <input type="checkbox"  id="my_choice_economy" name="my_choice_economy[]" value="Family Supported" @if(in_array('Family Supported',$my_choice_economy)) checked='checked' @endif style="margin-left: 5px;">Family Supported
                    <input type="checkbox"  id="my_choice_economy" name="my_choice_economy[]" value="Independent" @if(in_array('Independent',$my_choice_economy)) checked='checked' @endif style="margin-left: 5px;">Independent 
                    <input type="checkbox"  id="my_choice_economy" name="my_choice_economy[]" value="Settled" @if(in_array('Settled',$my_choice_economy)) checked='checked' @endif style="margin-left: 5px;">Settled
                    <input type="checkbox"  id="my_choice_economy" name="my_choice_economy[]" value="Well Settled" @if(in_array('Well Settled',$my_choice_economy)) checked='checked' @endif style="margin-left: 5px;">Well Settled 
                    <input type="checkbox"  id="my_choice_economy" name="my_choice_economy[]" value="Any" @if(in_array('Any',$my_choice_economy)) checked='checked' @endif style="margin-left: 5px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_economy"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="marital_status" class="col-sm-2 control-label">My Marital Status</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="marital_status" name="marital_status" value="Never Married" @if($user->marital_status=='Never Married') checked='checked' @endif style="margin-left: 12px;">Never Married
                    <input type="radio"  id="marital_status" name="marital_status" value="Divorced" @if($user->marital_status=='Divorced') checked='checked' @endif style="margin-left: 12px;">Divorced
                    <input type="radio"  id="marital_status" name="marital_status" value="Widowed" @if($user->marital_status=='Widowed') checked='checked' @endif style="margin-left: 12px;">Widowed 
                    <input type="radio"  id="marital_status" name="marital_status" value="Separated" @if($user->marital_status=='Separated') checked='checked' @endif style="margin-left: 12px;">Separated
                    <input type="radio"  id="marital_status" name="marital_status" value="Married" @if($user->marital_status=='Married') checked='checked' @endif style="margin-left: 12px;">Married
                    <br>
                    <span class="text-red">
                      <strong class="marital_status"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_choice_marital_status = explode(",",$user->my_choice_marital_status);
                      
                ?>

                <div class="form-group">
                  <label for="my_choice_marital_status" class="col-sm-2 control-label">My Choice Marital Status</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_marital_status" name="my_choice_marital_status[]" value="Never Married" @if(in_array('Never Married',$my_choice_marital_status)) checked='checked' @endif style="margin-left: 5px;">Never Married
                    <input type="checkbox"  id="my_choice_marital_status" name="my_choice_marital_status[]" value="Divorced" @if(in_array('Divorced',$my_choice_marital_status)) checked='checked' @endif style="margin-left: 5px;">Divorced
                    <input type="checkbox"  id="my_choice_marital_status" name="my_choice_marital_status[]" value="Widowed" @if(in_array('Widowed',$my_choice_marital_status)) checked='checked' @endif style="margin-left: 5px;">Widowed 
                    <input type="checkbox"  id="my_choice_marital_status" name="my_choice_marital_status[]" value="Separated" @if(in_array('Separated',$my_choice_marital_status)) checked='checked' @endif style="margin-left: 5px;">Separated
                    <input type="checkbox"  id="my_choice_marital_status" name="my_choice_marital_status[]" value="Married" @if(in_array('Married',$my_choice_marital_status)) checked='checked' @endif style="margin-left: 5px;">Married 
                    <input type="checkbox"  id="my_choice_marital_status" name="my_choice_marital_status[]" value="Any" @if(in_array('Any',$my_choice_marital_status)) checked='checked' @endif style="margin-left: 5px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_marital_status"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_children" class="col-sm-2 control-label">My Children</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_children" name="my_children" value="No" @if($user->my_children=='No') checked='checked' @endif style="margin-left: 12px;">No
                    <input type="radio"  id="my_children" name="my_children" value="Yes,Not Living With Me" @if($user->my_children=='Yes,Not Living With Me') checked='checked' @endif style="margin-left: 12px;">Yes,Not Living With Me
                    <input type="radio"  id="my_children" name="my_children" value="Yes,Living With Me" @if($user->my_children=='Yes,Living With Me') checked='checked' @endif style="margin-left: 12px;">Yes,Living With Me
                    <br>
                    <span class="text-red">
                      <strong class="my_children"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_choice_children = explode("@",$user->my_choice_children);
                      
                ?>

                <div class="form-group">
                  <label for="my_choice_children" class="col-sm-2 control-label">My Choice Children</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_children" name="my_choice_children[]" value="No" @if(in_array('No',$my_choice_children)) checked='checked' @endif style="margin-left: 12px;">No
                    <input type="checkbox"  id="my_choice_children" name="my_choice_children[]" value="Yes,Not Living With Me" @if(in_array('Yes,Not Living With Me',$my_choice_children)) checked='checked' @endif style="margin-left: 12px;">Yes,Not Living With Me
                    <input type="checkbox"  id="my_choice_children" name="my_choice_children[]" value="Yes,Living With Me" @if(in_array('Yes,Living With Me',$my_choice_children)) checked='checked' @endif style="margin-left: 12px;">Yes,Living With Me 
                    <input type="checkbox"  id="my_choice_children" name="my_choice_children[]" value="Any" @if(in_array('Any',$my_choice_children)) checked='checked' @endif style="margin-left: 12px;">Any
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
                       <option value="First Child" @if($user->my_sibling_position=="First Child") selected='selected' @endif>First Child</option>
                       <option value="Middle Child" @if($user->my_sibling_position=="Middle Child") selected='selected' @endif>Middle Child</option>
                       <option value="Last Child" @if($user->my_sibling_position=="Last Child") selected='selected' @endif>Last Child</option>
                    </select >  
                    <span class="text-red">
                                <strong class="my_sibling_position"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="no_of_brothers" class="col-sm-2 control-label">No Of Brothers</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="no_of_brothers" name="no_of_brothers" placeholder="" value="{{ $user->no_of_brothers }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="no_of_brothers"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="no_of_sisters" class="col-sm-2 control-label">No Of Sisters</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="no_of_sisters" name="no_of_sisters" placeholder="" value="{{ $user->no_of_sisters }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="no_of_sisters"></strong>
                      </span>
                  </div>
                </div>

                 <div class="form-group">
                  <label for="my_family_values" class="col-sm-2 control-label">My Family Values</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_family_values" name="my_family_values" value="Religious" @if($user->my_family_values=='Religious') checked='checked' @endif style="margin-left: 12px;">Religious
                    <input type="radio"  id="my_family_values" name="my_family_values" value="Traditional" @if($user->my_family_values=='Traditional') checked='checked' @endif style="margin-left: 12px;">Traditional
                    <input type="radio"  id="my_family_values" name="my_family_values" value="Moderate" @if($user->my_family_values=='Moderate') checked='checked' @endif style="margin-left: 12px;">Moderate 
                    <input type="radio"  id="my_family_values" name="my_family_values" value="Modern" @if($user->my_family_values=='Modern') checked='checked' @endif style="margin-left: 12px;">Modern
                    <br>
                    <span class="text-red">
                      <strong class="my_family_values"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_choice_family = explode(",",$user->my_choice_family);
                      
                ?>

                <div class="form-group">
                  <label for="my_choice_family" class="col-sm-2 control-label">My Choice Family Values</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_family" name="my_choice_family[]" value="Religious"  @if(in_array('Religious',$my_choice_family)) checked='checked' @endif style="margin-left: 12px;">Religious
                    <input type="checkbox"  id="my_choice_family" name="my_choice_family[]" value="Traditional"  @if(in_array('Traditional',$my_choice_family)) checked='checked' @endif style="margin-left: 12px;">Traditional
                    <input type="checkbox"  id="my_choice_family" name="my_choice_family[]" value="Moderate"  @if(in_array('Moderate',$my_choice_family)) checked='checked' @endif style="margin-left: 12px;">Moderate 
                    <input type="checkbox"  id="my_choice_family" name="my_choice_family[]" value="Modern"  @if(in_array('Modern',$my_choice_family)) checked='checked' @endif style="margin-left: 12px;">Modern
                    <input type="checkbox"  id="my_choice_family" name="my_choice_family[]" value="Any"  @if(in_array('Any',$my_choice_family)) checked='checked' @endif style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_family"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_living_arrangement" class="col-sm-2 control-label">My Living Arrangements</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_living_arrangement" name="my_living_arrangement" value="Homeowner" @if($user->my_living_arrangement=='Homeowner') checked='checked' @endif style="margin-left: 12px;">Homeowner
                    <input type="radio"  id="my_living_arrangement" name="my_living_arrangement" value="Rental Apartment" @if($user->my_living_arrangement=='Rental Apartment') checked='checked' @endif style="margin-left: 12px;">Rental Apartment
                    <input type="radio"  id="my_living_arrangement" name="my_living_arrangement" value="Living With Family" @if($user->my_living_arrangement=='Living With Family') checked='checked' @endif style="margin-left: 12px;">Living With Family 
                    <br>
                    <span class="text-red">
                      <strong class="my_living_arrangement"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_choice_living_arrangement = explode(",",$user->my_choice_living_arrangement);
                      
                ?>

                <div class="form-group">
                  <label for="my_choice_living_arrangement" class="col-sm-2 control-label">My Choice Living Arrangements</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_living_arrangement" name="my_choice_living_arrangement[]" value="Homeowner"  @if(in_array('Homeowner',$my_choice_living_arrangement)) checked='checked' @endif style="margin-left: 12px;">Homeowner
                    <input type="checkbox"  id="my_choice_living_arrangement" name="my_choice_living_arrangement[]" value="Rental Apartment"  @if(in_array('Rental Apartment',$my_choice_living_arrangement)) checked='checked' @endif style="margin-left: 12px;">Rental Apartment
                    <input type="checkbox"  id="my_choice_living_arrangement" name="my_choice_living_arrangement[]" value="Living With Family"  @if(in_array('Living With Family',$my_choice_living_arrangement)) checked='checked' @endif style="margin-left: 12px;">Living With Family 
                    <input type="checkbox"  id="my_choice_living_arrangement" name="my_choice_living_arrangement[]" value="Any"  @if(in_array('Any',$my_choice_living_arrangement)) checked='checked' @endif style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_living_arrangement"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_raised" class="col-sm-2 control-label">My Raised,Where</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_raised" name="my_raised" value="Eastern Countries" @if($user->my_raised=='Eastern Countries') checked='checked' @endif style="margin-left: 12px;">Eastern Countries
                    <input type="radio"  id="my_raised" name="my_raised" value="Western Countries" @if($user->my_raised=='Western Countries') checked='checked' @endif style="margin-left: 12px;">Western Countries
                    <input type="radio"  id="my_raised" name="my_raised" value="Eastern and Western" @if($user->my_raised=='Eastern and Western') checked='checked' @endif style="margin-left: 12px;">Eastern and Western 
                    <br>
                    <span class="text-red">
                      <strong class="my_raised"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_choice_raised = explode(",",$user->my_choice_raised);
                      
                ?>

                <div class="form-group">
                  <label for="my_choice_raised" class="col-sm-2 control-label">My Choice Raised,Where</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_raised" name="my_choice_raised[]" value="Eastern Countries"  @if(in_array('Eastern Countries',$my_choice_raised)) checked='checked' @endif style="margin-left: 12px;">Eastern Countries
                    <input type="checkbox"  id="my_choice_raised" name="my_choice_raised[]" value="Western Countries"  @if(in_array('Western Countries',$my_choice_raised)) checked='checked' @endif style="margin-left: 12px;">Western Countries
                    <input type="checkbox"  id="my_choice_raised" name="my_choice_raised[]" value="Eastern and Western"  @if(in_array('Eastern and Western',$my_choice_raised)) checked='checked' @endif style="margin-left: 12px;">Eastern and Western 
                    <input type="checkbox"  id="my_choice_raised" name="my_choice_raised[]" value="Any"  @if(in_array('Any',$my_choice_raised)) checked='checked' @endif style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_raised"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_hijab" class="col-sm-2 control-label">My Hijab</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_hijab" name="my_hijab" value="Very Important" @if($user->my_hijab=='Very Important') checked='checked' @endif style="margin-left: 12px;">Very Important
                    <input type="radio"  id="my_hijab" name="my_hijab" value="Not Very Important" @if($user->my_hijab=='Not Very Important') checked='checked' @endif style="margin-left: 12px;">Not Very Important
                    <br>
                    <span class="text-red">
                      <strong class="my_hijab"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_choice_hijab = explode(",",$user->my_choice_hijab);
                      
                ?>

                <div class="form-group">
                  <label for="my_choice_hijab" class="col-sm-2 control-label">My Choice Hijab</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_hijab" name="my_choice_hijab[]" value="Very Important"  @if(in_array('Very Important',$my_choice_hijab)) checked='checked' @endif style="margin-left: 12px;">Very Important
                    <input type="checkbox"  id="my_choice_hijab" name="my_choice_hijab[]" value="Not Very Important"  @if(in_array('Not Very Important',$my_choice_hijab)) checked='checked' @endif style="margin-left: 12px;">Not Very Important
                    <input type="checkbox"  id="my_choice_hijab" name="my_choice_hijab[]" value="Any"  @if(in_array('Any',$my_choice_hijab)) checked='checked' @endif style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_hijab"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_smoke" class="col-sm-2 control-label">My Self Smoke</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_smoke" name="my_smoke" value="Non Smoker" @if($user->my_smoke=='Non Smoker') checked='checked' @endif style="margin-left: 12px;">Non Smoker
                    <input type="radio"  id="my_smoke" name="my_smoke" value="Sometimes" @if($user->my_smoke=='Sometimes') checked='checked' @endif style="margin-left: 12px;">Sometimes
                    <input type="radio"  id="my_smoke" name="my_smoke" value="Smoker" @if($user->my_smoke=='Smoker') checked='checked' @endif style="margin-left: 12px;">Smoker 
                    <br>
                    <span class="text-red">
                      <strong class="my_smoke"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_choice_smoke = explode(",",$user->my_choice_smoke);
                      
                ?>

                <div class="form-group">
                  <label for="my_choice_smoke" class="col-sm-2 control-label">My Choice Smoke</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_smoke" name="my_choice_smoke[]" value="Non Smoker"  @if(in_array('Non Smoker',$my_choice_smoke)) checked='checked' @endif style="margin-left: 12px;">Non Smoker
                    <input type="checkbox"  id="my_choice_smoke" name="my_choice_smoke[]" value="Sometimes"  @if(in_array('Sometimes',$my_choice_smoke)) checked='checked' @endif style="margin-left: 12px;">Sometimes
                    <input type="checkbox"  id="my_choice_smoke" name="my_choice_smoke[]" value="Smoker"  @if(in_array('Smoker',$my_choice_smoke)) checked='checked' @endif style="margin-left: 12px;">Smoker 
                    <input type="checkbox"  id="my_choice_smoke" name="my_choice_smoke[]" value="Any"  @if(in_array('Any',$my_choice_smoke)) checked='checked' @endif style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_smoke"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_drink" class="col-sm-2 control-label">My Self Drink</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_drink" name="my_drink" value="Never" @if($user->my_drink=='Never') checked='checked' @endif style="margin-left: 12px;">Never
                    <input type="radio"  id="my_drink" name="my_drink" value="Occasionally" @if($user->my_drink=='Occasionally') checked='checked' @endif style="margin-left: 12px;">Occasionally
                    <input type="radio"  id="my_drink" name="my_drink" value="Regularly" @if($user->my_drink=='Regularly') checked='checked' @endif style="margin-left: 12px;">Regularly 
                    <br>
                    <span class="text-red">
                      <strong class="my_drink"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_choice_drink = explode(",",$user->my_choice_drink);
                      
                ?>

                <div class="form-group">
                  <label for="my_choice_drink" class="col-sm-2 control-label">My Choice Drink</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_drink" name="my_choice_drink[]" value="Never"  @if(in_array('Never',$my_choice_drink)) checked='checked' @endif style="margin-left: 12px;">Never
                    <input type="checkbox"  id="my_choice_drink" name="my_choice_drink[]" value="Occasionally"  @if(in_array('Occasionally',$my_choice_drink)) checked='checked' @endif style="margin-left: 12px;">Occasionally
                    <input type="checkbox"  id="my_choice_drink" name="my_choice_drink[]" value="Regularly"  @if(in_array('Regularly',$my_choice_drink)) checked='checked' @endif style="margin-left: 12px;">Regularly 
                    <input type="checkbox"  id="my_choice_drink" name="my_choice_drink[]" value="Any" @if(in_array('Any',$my_choice_drink)) checked='checked' @endif  style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_drink"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_disability" class="col-sm-2 control-label">My Disability</label>
                  <div class="col-sm-6">
                    <input type="radio"  id="my_disability" name="my_disability" value="No" @if($user->my_disability=='No') checked='checked' @endif style="margin-left: 12px;">No
                    <input type="radio"  id="my_disability" name="my_disability" value="Yes i have disability" @if($user->my_disability=='Yes i have disability') checked='checked' @endif style="margin-left: 12px;">Yes i have disability
                    <input type="radio"  id="my_disability" name="my_disability" value="Yes but does't impact much" @if($user->my_disability=="Yes but does't impact much") checked='checked' @endif style="margin-left: 12px;">Yes but does't impact much 
                    <br>
                    <span class="text-red">
                      <strong class="my_disability"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_choice_disability = explode(",",$user->my_choice_disability);
                      
                ?>

                <div class="form-group">
                  <label for="my_choice_disability" class="col-sm-2 control-label">My Choice Disability</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_choice_disability" name="my_choice_disability[]" value="No" @if(in_array('No',$my_choice_disability)) checked='checked' @endif style="margin-left: 12px;">No
                    <input type="checkbox"  id="my_choice_disability" name="my_choice_disability[]" value="Yes i have disability" @if(in_array('Yes i have disability',$my_choice_disability)) checked='checked' @endif style="margin-left: 12px;">Yes i have disability
                    <input type="checkbox"  id="my_choice_disability" name="my_choice_disability[]" value="Yes but does't impact much" @if(in_array("Yes but does't impact much",$my_choice_disability)) checked='checked' @endif style="margin-left: 12px;">Yes but does't impact much 
                    <input type="checkbox"  id="my_choice_disability" name="my_choice_disability[]" value="Any" @if(in_array('Any',$my_choice_disability)) checked='checked' @endif style="margin-left: 12px;">Any
                    <br>
                    <span class="text-red">
                      <strong class="my_choice_disability"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $interest = explode(",",$user->interest);
                      
                ?>

                <div class="form-group">
                  <label for="interest" class="col-sm-2 control-label">Interest</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="interest" name="interest[]" value="Art" @if(in_array('Art',$interest)) checked='checked' @endif style="margin-left: 12px;">Art
                    <input type="checkbox"  id="interest" name="interest[]" value="Astrology" @if(in_array('Astrology',$interest)) checked='checked' @endif style="margin-left: 12px;">Astrology 
                    <input type="checkbox"  id="interest" name="interest[]" value="Boats" @if(in_array('Boats',$interest)) checked='checked' @endif style="margin-left: 12px;">Boats
                    <input type="checkbox"  id="interest" name="interest[]" value="Community Service" @if(in_array('Community Service',$interest)) checked='checked' @endif style="margin-left: 12px;">Community Service
                    <input type="checkbox"  id="interest" name="interest[]" value="Cooking" @if(in_array('Cooking',$interest)) checked='checked' @endif style="margin-left: 12px;">Cooking
                    <input type="checkbox"  id="interest" name="interest[]" value="Dining" @if(in_array('Dining',$interest)) checked='checked' @endif style="margin-left: 12px;">Dining
                    <input type="checkbox"  id="interest" name="interest[]" value="Family Life" @if(in_array('Family Life',$interest)) checked='checked' @endif style="margin-left: 12px;">Family Life
                    <input type="checkbox"  id="interest" name="interest[]" value="Fishing" @if(in_array('Fishing',$interest)) checked='checked' @endif style="margin-left: 12px;">Fishing
                    <input type="checkbox"  id="interest" name="interest[]" value="Games" @if(in_array('Games',$interest)) checked='checked' @endif style="margin-left: 12px;">Games
                    <input type="checkbox"  id="interest" name="interest[]" value="Health / Fitness" @if(in_array('Health / Fitness',$interest)) checked='checked' @endif style="margin-left: 12px;">Health / Fitness
                    <input type="checkbox"  id="interest" name="interest[]" value="Hunting" @if(in_array('Hunting',$interest)) checked='checked' @endif style="margin-left: 12px;">Hunting
                    <input type="checkbox"  id="interest" name="interest[]" value="Learning" @if(in_array('Learning',$interest)) checked='checked' @endif style="margin-left: 12px;">Learning
                    <input type="checkbox"  id="interest" name="interest[]" value="Movies / Television" @if(in_array('Movies / Television',$interest)) checked='checked' @endif style="margin-left: 12px;">Movies / Television
                    <input type="checkbox"  id="interest" name="interest[]" value="Pets" @if(in_array('Pets',$interest)) checked='checked' @endif style="margin-left: 12px;">Pets
                    <input type="checkbox"  id="interest" name="interest[]" value="Singing" @if(in_array('Singing',$interest)) checked='checked' @endif style="margin-left: 12px;">Singing
                    <input type="checkbox"  id="interest" name="interest[]" value="Reading" @if(in_array('Reading',$interest)) checked='checked' @endif style="margin-left: 12px;">Reading
                    <input type="checkbox"  id="interest" name="interest[]" value="Socialize" @if(in_array('Socialize',$interest)) checked='checked' @endif style="margin-left: 12px;">Socialize
                    <input type="checkbox"  id="interest" name="interest[]" value="Sewing and Sitching" @if(in_array('Sewing and Sitching',$interest)) checked='checked' @endif style="margin-left: 12px;">Sewing and Sitching
                    <input type="checkbox"  id="interest" name="interest[]" value="Traveling" @if(in_array('Traveling',$interest)) checked='checked' @endif style="margin-left: 12px;">Traveling
                    <input type="checkbox"  id="interest" name="interest[]" value="Volunteering" @if(in_array('Volunteering',$interest)) checked='checked' @endif style="margin-left: 12px;">Volunteering
                    <input type="checkbox"  id="interest" name="interest[]" value="Art and Craft" @if(in_array('Art and Craft',$interest)) checked='checked' @endif style="margin-left: 12px;">Art and Craft 
                    <input type="checkbox"  id="interest" name="interest[]" value="Bicycling" @if(in_array('Bicycling',$interest)) checked='checked' @endif style="margin-left: 12px;">Bicycling
                    <input type="checkbox"  id="interest" name="interest[]" value="Cars" @if(in_array('Cars',$interest)) checked='checked' @endif style="margin-left: 12px;">Cars
                    <input type="checkbox"  id="interest" name="interest[]" value="Computers" @if(in_array('Computers',$interest)) checked='checked' @endif style="margin-left: 12px;">Computers
                    <input type="checkbox"  id="interest" name="interest[]" value="Dancing" @if(in_array('Dancing',$interest)) checked='checked' @endif style="margin-left: 12px;">Dancing
                    <input type="checkbox"  id="interest" name="interest[]" value="Driving" @if(in_array('Driving',$interest)) checked='checked' @endif style="margin-left: 12px;">Driving
                    <input type="checkbox"  id="interest" name="interest[]" value="Fashion" @if(in_array('Fashion',$interest)) checked='checked' @endif style="margin-left: 12px;">Fashion
                    <input type="checkbox"  id="interest" name="interest[]" value="Electronics" @if(in_array('Electronics',$interest)) checked='checked' @endif style="margin-left: 12px;">Electronics
                    <input type="checkbox"  id="interest" name="interest[]" value="Gardening" @if(in_array('Gardening',$interest)) checked='checked' @endif style="margin-left: 12px;">Gardening
                    <input type="checkbox"  id="interest" name="interest[]" value="Hosting / Entertaining" @if(in_array('Hosting / Entertaining',$interest)) checked='checked' @endif style="margin-left: 12px;">Hosting / Entertaining
                    <input type="checkbox"  id="interest" name="interest[]" value="Interior Design" @if(in_array('Interior Design',$interest)) checked='checked' @endif style="margin-left: 12px;">Interior Design
                    <input type="checkbox"  id="interest" name="interest[]" value="Motorcycle" @if(in_array('Motorcycle',$interest)) checked='checked' @endif style="margin-left: 12px;">Motorcycle
                    <input type="checkbox"  id="interest" name="interest[]" value="Music" @if(in_array('Music',$interest)) checked='checked' @endif style="margin-left: 12px;">Music
                    <input type="checkbox"  id="interest" name="interest[]" value="Parties" @if(in_array('Parties',$interest)) checked='checked' @endif style="margin-left: 12px;">Parties
                    <input type="checkbox"  id="interest" name="interest[]" value="Photography" @if(in_array('Photography',$interest)) checked='checked' @endif style="margin-left: 12px;">Photography
                    <input type="checkbox"  id="interest" name="interest[]" value="Politics" @if(in_array('Politics',$interest)) checked='checked' @endif style="margin-left: 12px;">Politics
                    <input type="checkbox"  id="interest" name="interest[]" value="Recreational Activites" @if(in_array('Recreational Activites',$interest)) checked='checked' @endif style="margin-left: 12px;">Recreational Activites
                    <input type="checkbox"  id="interest" name="interest[]" value="Shopping" @if(in_array('Shopping',$interest)) checked='checked' @endif style="margin-left: 12px;">Shopping
                    <input type="checkbox"  id="interest" name="interest[]" value="Swimming" @if(in_array('Swimming',$interest)) checked='checked' @endif style="margin-left: 12px;">Swimming
                    <input type="checkbox"  id="interest" name="interest[]" value="Video Games" @if(in_array('Video Games',$interest)) checked='checked' @endif style="margin-left: 12px;">Video Games
                    <input type="checkbox"  id="interest" name="interest[]" value="Sports" @if(in_array('Sports',$interest)) checked='checked' @endif style="margin-left: 12px;">Sports
                    <br>
                    <span class="text-red">
                      <strong class="interest"></strong>
                    </span>
                  </div>
                </div>

                <?php
                      $my_personality = explode(",",$user->my_personality);
                ?>

                <div class="form-group">
                  <label for="my_personality" class="col-sm-2 control-label">My Personality</label>
                  <div class="col-sm-6">
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Charming" @if(in_array('Charming',$my_personality)) checked='checked' @endif style="margin-left: 12px;">Charming
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Extrovert" @if(in_array('Extrovert',$my_personality)) checked='checked' @endif style="margin-left: 12px;">Extrovert
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Introvert" @if(in_array('Introvert',$my_personality)) checked='checked' @endif style="margin-left: 12px;">Introvert 
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Sensitive" @if(in_array('Sensitive',$my_personality)) checked='checked' @endif style="margin-left: 12px;">Sensitive
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Serious" @if(in_array('Serious',$my_personality)) checked='checked' @endif style="margin-left: 12px;">Serious
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Shy" @if(in_array('Shy',$my_personality)) checked='checked' @endif style="margin-left: 12px;">Shy
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Simple" @if(in_array('Simple',$my_personality)) checked='checked' @endif style="margin-left: 12px;">Simple
                    <input type="checkbox"  id="my_personality" name="my_personality[]" value="Witty" @if(in_array('Witty',$my_personality)) checked='checked' @endif style="margin-left: 12px;">Witty
                    <br>
                    <span class="text-red">
                      <strong class="my_personality"></strong>
                    </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="about" class="col-sm-2 control-label">About My Personality</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="about" name="about" placeholder="" value="{{ $user->about }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="about"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="about_my_choice" class="col-sm-2 control-label">About My Choice Personality</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="about_my_choice" name="about_my_choice" placeholder="" value="{{ $user->about_my_choice }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="about_my_choice"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_strengths" class="col-sm-2 control-label">My Strengths</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="my_strengths" name="my_strengths" placeholder="" value="{{ $user->my_strengths }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="my_strengths"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="my_weekness" class="col-sm-2 control-label">My Weekness</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="my_weekness" name="my_weekness" placeholder="" value="{{ $user->my_weekness }}" autocomplete="off" require>
                      <span class="text-red">
                        <strong class="my_weekness"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="terms_and_condition" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
                    <input type="checkbox"  id="terms_and_condition" name="terms_and_condition" value="true" @if($user->terms_and_condition=='true') checked='checked' @endif style="margin-right: 12px;">Terms and Conditions
                     <span class="text-red">
                      <strong class="terms_and_condition"></strong>
                    </span>
                  </div>
                </div>

               <!-- end fields-->
              </div>
            </div> 

          

          </div>

               <input name="edit_id" type="hidden" value="{{ $user->id }}" id="edit_id">
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info" id="add-form-btn">Update</button>
                <a href="{!! url('/admin/customers'); !!}" class="btn btn-default pull-right">Cancel</a>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
@endsection

@push('scripts')
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
        $("."+index).delay(3000).fadeOut(); 
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
<script>
  @if(isset($user->avatar) && $user->avatar!='')
      var avatarName="{{ URL::to('/').Storage::disk('local')->url('public/users/'.$user->id.'/'.$user->avatar)}} ";
    @else
    var avatarName="{{ asset ('img/placeholder.png') }}";
    @endif

  $("#avatar").fileinput({
      overwriteInitial: true,
      maxFileSize: 1000,
      showClose: false,
      showCaption: false,
      browseLabel: '',
      removeLabel: '',
      browseOnZoneClick: true,
      browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
      removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
      removeTitle: 'Cancel or reset changes',
      elErrorContainer: '#kv-avatar-errors-1',
      msgErrorClass: 'alert alert-block alert-danger',
      defaultPreviewContent: '<img src="'+ avatarName +'" alt="Avatar" width="100%">',
      layoutTemplates: {main2: '{preview} {browse}'},
      allowedFileExtensions: ["jpg", "png", "gif"]
  });
  </script>
@endpush
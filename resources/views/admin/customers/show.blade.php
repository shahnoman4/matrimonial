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
              <h3 class="box-title">{{$user->name}} Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
            <div class="row">
              <div class="col-md-4 text-center">
                  <div class="kv-avatar">
                          <img src="{{ URL::to('/').Storage::disk('local')->url('public/users/'.$user->id.'/'.$user->avatar)}}" width="90%">
                  </div>
              </div> 
              <div class="col-md-8">
              <table class="table table-striped">
                <tr>
                    <td><b> Name</b></td>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <td><b>Mobile</b></td>
                    <td>{{$user->mobile}}</td>
                </tr>
                
               
                <tr>
                    <td><b>Created At</b></td>
                    <td>{{$user->created_at->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td><b>Updated At</b></td>
                    <td>{{$user->updated_at->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td>
                        @if ($user->status === 1)
                          <span class="text-green"><b>Active</b></span>
                        @else
                            <span class="text-red"><b>Deactive</b></span>
                        @endif
                    </td>
                </tr>
                
              </table>
                  

              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/admin/customers'); !!}" class="btn btn-default">Back</a>
              </div>
              <!-- /.box-footer -->

</div>

<!-- Basic info and apparance -->
<div class="row">
    <div class="col-md-6">
      <div class="box box-info">
              <div class="box-header with-border">
                  <h3 class="box-title">Basic Info</h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                  </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="row">
                      <div class="col-md-12">
                          <table class="table table-striped">
                                <tr>
                                    <td><b>Profile Created By</b></td>
                                    <td>{{$user->profile_created_by}}</td>
                                </tr>
                                <tr>
                                    <td><b>Gender</b></td>
                                    <td>{{$user->gender}}</td>
                                </tr>
                                <tr>
                                    <td><b>Date Of Birth</b></td>
                                    <td>{{$user->date_of_birth}}</td>
                                </tr>
                                <tr>
                                    <td><b>My City</b></td>
                                    <td>{{$user->my_city}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice City</b></td>
                                    <td>{{$user->my_choice_city}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Country</b></td>
                                    <td>{{$user->my_country}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Country</b></td>
                                    <td>{{$user->my_country_choice}}</td>
                                </tr>
                                 <tr>
                                    <td><b>Religion</b></td>
                                    <td>{{$user->religion}}</td>
                                </tr>
                                 <tr>
                                    <td><b>Mother Tongue</b></td>
                                    <td>{{$user->mother_tongue}}</td>
                                </tr>
                                 <tr>
                                    <td><b>My Visa</b></td>
                                    <td>{{$user->my_visa}}</td>
                                </tr>
                                 <tr>
                                    <td><b>My Choice Visa</b></td>
                                    <td>{{$user->my_choice_visa}}</td>
                                </tr>
                          </table>
                      </div>
                  </div>
              </div>
      </div>
    </div>
  
    
    <div class="col-md-6">
        <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Appearance</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                                <tr>
                                    <td><b>My Physique</b></td>
                                    <td>{{$user->my_physique}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Physique</b></td>
                                    <td>{{$user->my_choice_physique}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Complexion</b></td>
                                    <td>{{$user->my_complexion}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Complexion</b></td>
                                    <td>{{$user->my_choice_complexion}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Hair Color</b></td>
                                    <td>{{$user->my_hair_color}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Hair Color</b></td>
                                    <td>{{$user->my_choice_hair_color}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Eye Color</b></td>
                                    <td>{{$user->my_eye_color}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Eye Color</b></td>
                                    <td>{{$user->my_choice_eye_color}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Height</b></td>
                                    <td>{{$user->my_height}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Height</b></td>
                                    <td>{{$user->my_choice_height_from}} To {{$user->my_choice_height_to}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Age</b></td>
                                    <td>{{$user->my_choice_age_from}} To {{$user->my_choice_age_to}}</td>
                                </tr>
                                
                          </table>           
                    </div>
                    </div>
                  </div>
        </div>
    </div>
</div>
<!-- Basic info and apparance  end-->

<!-- Life Style -->
<div class="row">
    <div class="col-md-6">
      <div class="box box-info">
              <div class="box-header with-border">
                  <h3 class="box-title">Life Style</h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="row">
                      <div class="col-md-12">
                          <table class="table table-striped">
                                <tr>
                                    <td><b>My Education</b></td>
                                    <td>{{$user->education}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Education Field</b></td>
                                    <td>{{$user->education_field}}</td>
                                </tr>
                                <tr>
                                    <td><b>Graduation Year</b></td>
                                    <td>{{$user->education_field_year}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Occupation</b></td>
                                    <td>{{$user->my_occupation}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Occupation</b></td>
                                    <td>{{$user->my_choice_occupation}}</td>
                                </tr>
                                <tr>
                                    <td><b>Income Level</b></td>
                                    <td>{{$user->income_level}}</td>
                                </tr>
                                <tr>
                                    <td><b>Caste</b></td>
                                    <td>{{$user->caste}}</td>
                                </tr>
                                 <tr>
                                    <td><b>My Economy</b></td>
                                    <td>{{$user->my_economy}}</td>
                                </tr>
                                 <tr>
                                    <td><b>My Choice Economy</b></td>
                                    <td>{{$user->my_choice_economy}}</td>
                                </tr>
                                 <tr>
                                    <td><b>My Marital Status</b></td>
                                    <td>{{$user->marital_status}}</td>
                                </tr>
                                 <tr>
                                    <td><b>My Choice Marital Status</b></td>
                                    <td>{{$user->my_choice_marital_status}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Children</b></td>
                                    <td>{{$user->my_children}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Children</b></td>
                                    <td>{{$user->my_choice_children}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Sibling Position</b></td>
                                    <td>{{$user->my_sibling_position}}</td>
                                </tr>
                                <tr>
                                    <td><b>No Of Brothers</b></td>
                                    <td>{{$user->no_of_brothers}}</td>
                                </tr>
                                <tr>
                                    <td><b>No Of Sisters</b></td>
                                    <td>{{$user->no_of_sisters}}</td>
                                </tr>
                          </table>
                      </div>
                  </div>
              </div>
      </div>
    </div>
  
    
    <div class="col-md-6">
        <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Life Style</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                                <tr>
                                    <td><b>My Family Values</b></td>
                                    <td>{{$user->my_family_values}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Family Values</b></td>
                                    <td>{{$user->my_choice_family}}</td>
                                </tr>
                                <tr>
                                    <td><b>My living Arrangement</b></td>
                                    <td>{{$user->my_living_arrangement}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice living Arrangement</b></td>
                                    <td>{{$user->my_choice_living_arrangement}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Raised</b></td>
                                    <td>{{$user->my_raised}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Raised</b></td>
                                    <td>{{$user->my_choice_raised}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Hijab</b></td>
                                    <td>{{$user->my_hijab}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Hijab</b></td>
                                    <td>{{$user->my_choice_hijab}}</td>
                                </tr>
                                
                                <tr>
                                    <td><b>My Smoke</b></td>
                                    <td>{{$user->my_smoke}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Smoke</b></td>
                                    <td>{{$user->my_choice_smoke}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Drink</b></td>
                                    <td>{{$user->my_drink}}</td>
                                </tr>

                                <tr>
                                    <td><b>My Choice Drink</b></td>
                                    <td>{{$user->my_choice_drink}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Disability</b></td>
                                    <td>{{$user->my_disability}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Choice Disability</b></td>
                                    <td>{{$user->my_choice_disability}}</td>
                                </tr>
                                
                          </table>           
                    </div>
                    </div>
                  </div>
        </div>
    </div>
</div>
<!-- Life Style  end-->

<!-- Interest and Personality -->
<div class="row">
    <div class="col-md-6">
      <div class="box box-info">
              <div class="box-header with-border">
                  <h3 class="box-title">Interest</h3>
                  <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="row">
                      <div class="col-md-12">
                          <table class="table table-striped">
                                <tr>
                                    <td><b>Interest</b></td>
                                    <td>{{$user->interest}}</td>
                                </tr>
                                
                          </table>
                      </div>
                  </div>
              </div>
      </div>
    </div>
  
    
    <div class="col-md-6">
        <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Personality</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                                <tr>
                                    <td><b>My Personality</b></td>
                                    <td>{{$user->my_personality}}</td>
                                </tr>
                                <tr>
                                    <td><b>About My Personality</b></td>
                                    <td>{{$user->about}}</td>
                                </tr>
                                <tr>
                                    <td><b>About My Choice Personality</b></td>
                                    <td>{{$user->about_my_choice}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Strengths</b></td>
                                    <td>{{$user->my_strengths}}</td>
                                </tr>
                                <tr>
                                    <td><b>My Weekness</b></td>
                                    <td>{{$user->my_weekness}}</td>
                                </tr>
                                <tr>
                                    <td><b>Terms and Conditions</b></td>
                                    <td>{{$user->terms_and_condition}}</td>
                                </tr>
                                
                                
                          </table>           
                    </div>
                    </div>
                  </div>
        </div>
    </div>
</div>
<!-- Interest and Personality end-->

@endsection


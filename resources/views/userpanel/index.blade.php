@include('userpanel.header')



            <h3 class="heading">User Profile Details</h3>

            <div class="user-form">
            <form id="profile_photo_form" action="{{url('/upload-profile-images')}}" method="POST" enctype="multipart/form-data">
            @csrf
                    <div class="row align-items-center mb-4 top-space">
                        <div class="col-md-5">
                            <div class="user-profile">
                                <div class="profile_photo_form">
                                    <div class="inner-photo">
                                   
                                    @if($usersdata->profile != '')
                                        <img src="{{ URL::to('/') }}/public/uploads/profile/{{ @$usersdata->profile }}" alt="Profile Photo" />
                                            @else
                                            <img src="{{url('public/userpanel/images/anshika-bist.webp')}}" alt="Profile Photo" />
                                            @endif
                                    </div>
                                    <div class="file file--upload">
                                        <label for="input-file" title="Change Profile Image">
                                            <img src="{{url('public/userpanel/images/pen-img.webp')}}" alt="Edit Icon"
                                                class="img-fluid" />
                                        </label>
                                        <input id="input-file" name="image" type="file" />
                                    </div>
                                </div>
                                </form>
                                <div class="details">
                                    <div class="inner-details">
                                        <h4>{{ @$usersdata->name }} </h4>
                                        <p>{{ @$usersdata->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                        <form action="{{url('/update-profiles')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                            <?php  $name = explode(" ", @$usersdata->name);
                                        $lastname = array_pop($name);
                                        $firstname = implode(" ", $name);
                                        
                                        ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">First Name</label>
                                       <input type="text" class="form-control"  id="Firstname" required  name="fname" aria-describedby="emailHelp" value="{{ @$firstname }}" placeholder="Enter your first name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Last Name</label>
                                        <input type="text" class="form-control" name="lname" id="Lastname" required value="{{ @$lastname }}" placeholder="Enter your last name">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ml-5 margin-position">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Email Id</label>
                                <input type="email" class="form-control" value="{{ @$usersdata->email}}" required name="email" id="Email-profile"  placeholder="example@gmail.com">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mobile No.</label>
                                <!-- <div class="iti iti--allow-dropdown iti--separate-dial-code"> -->
                                    <input type="tel"  class="form-control" placeholder="9990009876" value="{{ @$usersdata->mobile }}" name="mobile" minlength="10" tabindex="4" maxlength="10" onkeydown="return ( event.ctrlKey || event.altKey
                                    || (47<event.keyCode &amp;&amp; event.keyCode<58 &amp;&amp; event.shiftKey==false)
                                    || (95<event.keyCode &amp;&amp; event.keyCode<106)
                                    || (event.keyCode==8) || (event.keyCode==9)
                                    || (event.keyCode>34 &amp;&amp; event.keyCode<40)
                                    || (event.keyCode==46) )" autocomplete="off"
                                            required />
                                <!-- </div> -->
                                <!-- <span class="user-var">Varify</span> -->
                            </div>
                        </div>
                        <!-- <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1"
                          >Alternative Mobile No.</label
                        >
                        <input
                          type="number"
                          class="form-control"
                          placeholder="Enter your first name"
                        />
                      </div>
                    </div> -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Date">Date of Birth</label>
                                <input type="date" name="dob" required value="{{ @$usersdata->dob }}" class="form-control datePicker" placeholder="Enter your date of birth">
                                <img src="{{url('public/userpanel/images/date-icon.webp')}}" class="icons"
                                    alt="Date Icon" />
                            </div>
                        </div>
                     <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Anniversary">Anniversary Date</label>
                                <input type="date" class="form-control datePicker"
                                    placeholder="Enter your Anniversary date" />
                                <img src="{{url('public/userpanel/images/aniversay-icon.webp')}}" class="icons"
                                    alt="Anniversary Icon" />
                            </div>
                        </div>
                       <!-- <div class="col-sm-12">
                            <div class="form-group">
                                <label for="Address">Address Line 1</label>
                                <input type="text" class="form-control" placeholder="Enter your Anniversary date" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="Address">Address Line 2</label>
                                <input type="text" class="form-control" placeholder="Enter your Anniversary date" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="City">City Name</label>
                                <input type="text" class="form-control" placeholder="Enter City/Town/District Name" />
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="Postal Code">Postal Code</label>
                                <input type="text" class="form-control" placeholder="Enter Pincode" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <span class="address-text">+ Add Another Address Details</span>
                            <div class="subs">
                                <div class="left">
                                    Subscribe for
                                    <img src="{{url('public/userpanel/images/whatsapp-img.webp')}}"
                                        alt="WhatsApp Icon" />
                                    notifications
                                </div>
                                <div class="right">
                                    <div class="radio-wrap">
                                        <span>
                                            <input type="radio" name="yes_no" checked="" />Yes
                                        </span>
                                        <span>
                                            <input type="radio" name="yes_no" />No
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-md-12">
                            <div class="submit-btn">
                                <button type="submit" class="theme-button">
                                    <span>Submit</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@include('userpanel.footer')

<script>
  $("#contact_code").intlTelInput({
    initialCountry: "in",
    separateDialCode: true,
  });
 
</script>


<script>
    $( "#input-file" ).change(function() {
    $('#profile_photo_form').submit();
  });
  var fileTag = document.getElementById("imageUpload"),
  preview = document.getElementById("currentimage");
        
  fileTag.addEventListener("change", function() {
     changeImage(this);
  });
    
  function changeImage(input) {
      var reader;
    
      if (input.files && input.files[0]) {
        reader = new FileReader();
        var fileName = input.files[0].name;
        reader.onload = function(e) {
            console.log(e.target.result);
          preview.setAttribute('src', e.target.result);
        }
    
        reader.readAsDataURL(input.files[0]);
      }
  }

  function deleteimage(){
      $.ajax({
        url: "{{url('/remove-profiles')}}",
        type: 'GET',
        dataType: 'json', // added data type
        success: function(res) {
            
        }
    });
    url = "{{url('website/userdashboard/dist/img')}}";

    url = url + '/user-profile-pic.png'
    preview.setAttribute('src', url);
  }

</script>
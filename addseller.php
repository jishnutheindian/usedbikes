<style type="text/css">
.form-style-8{
    font-family: 'Open Sans Condensed', arial, sans;
    width: 500px;
    padding: 30px;
    background: #FFFFFF;
    margin: 50px auto;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.22);
    -moz-box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.22);
    -webkit-box-shadow:  0px 0px 15px rgba(0, 0, 0, 0.22);

}
.form-style-8 h2{
    background: #4D4D4D;
    text-transform: uppercase;
    font-family: 'Open Sans Condensed', sans-serif;
    color: #797979;
    font-size: 18px;
    font-weight: 100;
    padding: 20px;
    margin: -30px -30px 30px -30px;
}
.form-style-8 input[type="text"],
.form-style-8 input[type="date"],
.form-style-8 input[type="datetime"],
.form-style-8 input[type="email"],
.form-style-8 input[type="number"],
.form-style-8 input[type="search"],
.form-style-8 input[type="time"],
.form-style-8 input[type="url"],
.form-style-8 input[type="password"],
.form-style-8 textarea,
.form-style-8 select 
{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    outline: none;
    display: block;
    width: 100%;
    padding: 7px;
    border: none;
    border-bottom: 1px solid #ddd;
    background: transparent;
    margin-bottom: 10px;
    font: 16px Arial, Helvetica, sans-serif;
    height: 45px;
}
.form-style-8 textarea{
    resize:none;
    overflow: hidden;
}
.form-style-8 input[type="button"], 
.form-style-8 input[type="submit"]{
    -moz-box-shadow: inset 0px 1px 0px 0px #45D6D6;
    -webkit-box-shadow: inset 0px 1px 0px 0px #45D6D6;
    box-shadow: inset 0px 1px 0px 0px #45D6D6;
    background-color: #2CBBBB;
    border: 1px solid #27A0A0;
    display: inline-block;
    cursor: pointer;
    color: #FFFFFF;
    font-family: 'Open Sans Condensed', sans-serif;
    font-size: 14px;
    padding: 8px 18px;
    text-decoration: none;
    text-transform: uppercase;
}
.form-style-8 input[type="button"]:hover, 
.form-style-8 input[type="submit"]:hover {
    background:linear-gradient(to bottom, #34CACA 5%, #30C9C9 100%);
    background-color:#34CACA;
}
</style>

<script type="text/javascript">

$(document).ready(function(){
      $("#blah").hide();
      $("#blah1").hide();
});


  $(document).ready(function(){
	$('#forms').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

       $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
             success:function(data){
                console.log(data);
				$("#sell").hide();
               if(data=="ok")
				{
                   document.getElementById("sell1").innerHTML ="<h2><b style='color:green;'>Your Data Submitted Successfully</b></h2>";}
			   else if(data=="error")
				{   document.getElementById("sell1").innerHTML ="<h2><b style='color:red;'>There was an error while uploading your data,please redo</b></h2>";}

			   else if(data=="notimage")
				{   document.getElementById("sell1").innerHTML ="<h2><b style='color:red;'>Please Check the image,unsupported filetype</b></h2>";
				   }
			   else if(data=="alreadyexists")
				{   document.getElementById("sell1").innerHTML ="<h2><b style='color:red;'>Unsuccesfull.Image already exists</b></h2>";
				   }
			   else if(data=="toolarge")
				{  document.getElementById("sell1").innerHTML ="<h2><b style='color:red;'>Too large image</b></h2>";}
			   else if(data=="notallowed")
				{  document.getElementById("sell1").innerHTML ="<h2><b style='color:red;'>These File types are not allowed</b></h2>";}
			   else{document.getElementById("sell1").innerHTML ="<h2><b style='color:red;'>Error Occured.Check your Data and retry. </b></h2>"; }
               
              },
            error: function(data){
                document.getElementById("sell1").innerHTML ="<h2><b style='color:red;'>Unexpected Error Occured</b></h2>";
            }
        });
     }));

	
   
});

</script><script type="text/javascript">

function adjust_textarea(h) {
    h.style.height = "20px";
    h.style.height = (h.scrollHeight)+"px";
}
function readURL(input) {
	 var x = document.getElementById('blah');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
			 x.style.display = 'block';
        }
    }

	function readUR(input) {
	 var x = document.getElementById('blah1');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah1')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
			 x.style.display = 'block';
        }
    }
</script>
<div id="sell1"></div>

<div id="sell" class="form-style-8">
  <h2 style="color:white;"><b>Add Seller<b></h2>
  <img style="align:right;padding:10px;" id="blah" src="#" alt="your image" />
<form action="addseller_dml.php" id="forms" enctype="multipart/form-data" method="post" onsubmit="">

    <input type="text" name="sname" placeholder="Seller Name" required/>
	<input type="text" name="fname" placeholder="Father Name" required/>

   <h4>Account Type</h4> <select name="acctype">
    <option value="user">user</option>
    <option value="partner">partner</option>
     </select> 

    <label><h4>Upload Photo of Seller</h4></label>
	<input type="file" name="spic" onchange="readURL(this);" style="align:right;" required/>
    
    <textarea name="address" onkeyup="adjust_textarea(this)" placeholder="Address" required></textarea>
    <input type="number" name="ph1" placeholder="phone number" required/>
    <input type="number" name="ph2" placeholder="conversation number" required/>

	

   <h4>Select Proof Type </h4> <select name="ptype">
  <option value="">None</option>
  <option value="adhar">adhar</option>
  <option value="voter id">Voter ID</option>
</select>

    <input type="text" name="proof" placeholder="Proof No" required/>
      <label><h4>Add Bike Photos </h4></label>
      <input type="file" name="bpic" onchange="readUR(this);" style="align:right;" required/>
       <img style="align:right;padding:10px;" id="blah1" src="#" alt="your image" />
       
   
   
	<input type="number" name="price" placeholder="price" required/>
    <input type="text" name="model" placeholder="Model Name" required/>
	<input type="number" name="vyear" placeholder="Model Year" required/>
    <input type="text" name="vno" placeholder="Vehicle Registration Number" required/>
    <input type="text" name="cno" placeholder="Chasis No" required />
	<input type="text" name="eno" placeholder="Engine Number" required/>
	<input type="text" name="dover" placeholder="Documents Handed Over" required/>
    <input id="send" type="submit" value="Upload" />

 </form>
</div>

$(".movetologin").click(function(){
	$(".registerForm").addClass("animate__fadeOutLeft");
	$(".registerForm").addClass("hide");
	$(".loginForm").removeClass("animate__fadeOutLeft");
	$(".loginForm").removeClass("hide");
});
$(".movetosignup").click(function(){
	$(".loginForm").addClass("animate__fadeOutLeft");
	$(".loginForm").addClass("hide");

	$(".registerForm").removeClass("animate__fadeOutLeft");
	$(".registerForm").addClass("animate__fadeInRight");
	$(".registerForm").removeClass("hide");
});
//validation

// initialize the validation library
let validation = new JustValidate('#RegForm', {
      errorFieldCssClass: 'is-invalid',
});
// apply rules to form fields
validation
  .addField('#fullname', [
  	{
      rule: 'required',
      errorMessage: 'Field is required',
    },
    {
      rule: 'minLength',
      value: 3,
    },
    {
      rule: 'maxLength',
      value: 20,
    },
  ])
  .addField('#username', [
  	{
      rule: 'required',
      errorMessage: 'Field is required',
    },
    {
      rule: 'minLength',
      value: 3,
    },
    {
      rule: 'maxLength',
      value: 20,
    },
  ])
  .addField('#email', [
     {
      rule: 'required',
      errorMessage: 'Field is required',
    },
    {
      rule: 'email',
      errorMessage: 'Email is invalid!',
    },
  ])
  .addField('#password', [
    {
      rule: 'required',
      errorMessage: 'Field is required',
    },
    {
      rule: 'minLength',
      value: 5,
    },
  ])
  .addField('#confpassword', [
    {
      rule: 'required',
      errorMessage: 'Field is required',
    },
    {
      rule: 'minLength',
      value: 5,
    },
  ])
  .addField('#terms', [
    {
      rule: 'required',
    },
  ])
  .onSuccess((event) => {
   	$("#RegForm").submit();
});

//login form validation

// initialize the validation library
const validation_login = new JustValidate('#LogForm', {
      errorFieldCssClass: 'is-invalid',
});
// apply rules to form fields
validation_login
  .addField('#emailLog', [
     {
      rule: 'required',
      errorMessage: 'Field is required',
    },
    {
      rule: 'email',
      errorMessage: 'Email is invalid!',
    },
  ])
  .addField('#passwordLog', [
  	{
      rule: 'required',
      errorMessage: 'Field is required',
    },
    {
      rule: 'minLength',
      value: 3,
    },
    {
      rule: 'maxLength',
      value: 20,
    },
  ])
  .onSuccess((event) => {
   	$("#LogForm").submit();
});
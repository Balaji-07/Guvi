const loginForm = document.querySelector(".form-inner");
const regForm = document.querySelector("form.register");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const err=document.querySelector(".errors");
const disp=document.querySelector(".container .form-inner .login");
  

signupBtn.onclick = (()=>{
    loginForm.style.marginLeft = "-100%";
    regForm.style.marginLeft = "100%";
    disp.style.display="none";
    err.style.display="none";
});
loginBtn.onclick = (()=>{
    loginForm.style.marginLeft = "0%";
    regForm.style.marginLeft = "130%";
    disp.style.display="";
    err.style.display="none";
});
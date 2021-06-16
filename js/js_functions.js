
// This is run when the remove check box's in the cart page are selected and is responsable for showing the 
// remove product button 
Array.from(document.getElementsByClassName('checkbox-remove')).forEach(function(element) {
  console.log('selected');
    element.addEventListener('change', (event) => {
        if(event.target.checked){
            document.getElementById('remove-thing').classList.remove("d-none");
        } 
    });
});

// This function ensures that the passwords (password and confirm password) 
//on the register pages both match
const check = function() {
    if (document.getElementById('password1').value ==
        document.getElementById('password2').value) {
        document.getElementById('message').classList.add('d-none');

        document.getElementById('registerButton').disabled = false;
    } else {
        document.getElementById('message').classList.remove('d-none');
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Passwords do not match';
        document.getElementById('registerButton').disabled = true;
    }
  }

  // this function reveals the password to the user when they click on the 
  // 'show password check box on the login and register page'
const handleShowPassword = function() {
    const input1 = document.getElementById("password1");
    const input2 = document.getElementById("password2");
    if (input1.type === "password") {
      input1.type = "text";
    } else {
      input1.type = "password";
    }
    if (input2.type === "password") {
        input2.type = "text";
      } else {
        input2.type = "password";
      }
  }

  const handleShowPasswordLogin = function() {
    const input = document.getElementById("password");
    if (input.type === "password") {
        input.type = "text";
      } else {
        input.type = "password";
      }
  }

  const handleShowPasswordOldPassword = function() {
    const input = document.getElementById("old_password");
    const input1 = document.getElementById("password1");
    const input2 = document.getElementById("password2");
    if (input1.type === "password") {
      input1.type = "text";
    } else {
      input1.type = "password";
    }
    if (input2.type === "password") {
        input2.type = "text";
      } else {
        input2.type = "password";
      }
    if (input.type === "password") {
        input.type = "text";
      } else {
        input.type = "password";
      }
  }

const oldPasswordWrong = function() {
  document.getElementById('oldPasswordWrong').innerHTML = 'Current password is incorrect';
}



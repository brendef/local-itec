var firebaseConfig = {
  apiKey: "AIzaSyDDu0GW93EoRaIvH0JCqqzJwytGWhQaU7o",
  authDomain: "fishermans-bay-images.firebaseapp.com",
  projectId: "fishermans-bay-images",
  storageBucket: "fishermans-bay-images.appspot.com",
  messagingSenderId: "724470534701",
  appId: "1:724470534701:web:cf956f8c4c4955e0019ea4"
};
Firebase.initializeApp(firebaseConfig);
const storage = firebase.storage();

function uploadImage() {
  const image = document.getElementById('product_image').files[0];
  const imageName = image.name;

  const storageRef = storage.ref('images/' + imageName);
  const upload = storageRef.put(image);

  upload.on('state_changed', function(snapshot) {
      let progress = (snapshot.bytesTransfered / snapshot.totalBytes) * 100;
      console.log('progress' + progress);
  }, function(error) {
      console.log(error);
  }, function() {
      upload.snapshot.ref.getDownloadURL().then(function(downloadURL) {
          console.log(downloadUrl);
      });
  });
}

Array.from(document.getElementsByClassName('checkbox-remove')).forEach(function(element) {
    element.addEventListener('change', (event) => {
        if(event.target.checked){
            document.getElementById('remove-thing').classList.remove("d-none");
        } 
    });
});

// if (document.getElementById('password1').value === '' && document.getElementById('password2').value === '') {
//     document.getElementById('registerButton').disabled = true;
// }

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



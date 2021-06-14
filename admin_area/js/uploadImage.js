var firebaseConfig = {
    apiKey: "AIzaSyDDu0GW93EoRaIvH0JCqqzJwytGWhQaU7o",
    authDomain: "fishermans-bay-images.firebaseapp.com",
    projectId: "fishermans-bay-images",
    storageBucket: "fishermans-bay-images.appspot.com",
    messagingSenderId: "724470534701",
    appId: "1:724470534701:web:cf956f8c4c4955e0019ea4"
};
firebase.initializeApp(firebaseConfig);
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
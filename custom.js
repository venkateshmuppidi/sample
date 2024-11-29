function generateQRCode() {
    var form_data = new FormData(document.getElementById("frmQRCode"));

    picture = document.getElementById('picture').files[0];
    form_data.append('picture', picture);

    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "generate-qrcode.php", true);
    xhttp.onload = function(event) {
        if (xhttp.status == 200) {
            if('success' == JSON.parse(this.response).code) {
                document.querySelector('#content').innerHTML = JSON.parse(this.response).content;
                document.querySelector(".qrcode-image").style.display = "block";
            } else {
                alert(JSON.parse(this.response).content);
            }
        } else {
            alert("Error " + xhttp.status + " occurred when trying to upload your documents.");
        }
    }

    xhttp.send(form_data);
}

function save_qrcode_to_pdf() {
    const { jsPDF } = window.jspdf;

    var doc = new jsPDF();


    var elementHTML = document.querySelector("#content");


    var fullname = document.getElementById('fullname').value;
    var email = document.getElementById('email').value;


    doc.text("Full Name: " + fullname, 15, 15);
    doc.text("Email: " + email, 15, 25);


    var imgElement = document.querySelector('#content img');

    var qrCodeImageData = imgElement.src;


    doc.html(elementHTML, {
        callback: function(doc) {
       
            doc.save('qrcode.pdf');
        },
        x: 15,
        y: 100, 
        width: 170,
        windowWidth: 650
    });
}

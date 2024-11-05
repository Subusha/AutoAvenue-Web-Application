<footer>
<script>
  // Get the button:
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
</script>

    <div class="footer-container">
        <div class="footer-section">
            <h4>Contact Information</h4>
            <p>AutoAvenue (Pvt. Ltd),Galle Road, Kamburugama, Matara</p>
            <p>Email: autoavenue@gmail.com</p>
            <p>Phone: 0778365137</p>
        </div>
        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./search.php">Search Cars</a></li>
                <li><a href="./add.php">Add New Car</a></li>
            </ul>
        </div>
    </div>
    <hr>
    <p class="copy">&copy; 2024 AutoAvenue (Pvt. Ltd). All rights reserved.</p>
    
    
    <div class="row" style="display:flex;justify-content:center;align-items:center">
   
   <style>
  .container {
    text-align: center;
    width:70px;
    margin-left:1450px;
    border-radius:10px;
    background-color:blue;
  }
  #myBtn {

    width:60px;
    margin-left:1455px;

}


  
</style>
<br><br><br>
      <button onclick="topFunction()" id="myBtn" title="top" name="upbtn">Top</button>
      </div>

  </div>
</footer>

<script>
  
let mybutton = document.getElementById("myBtn");

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0; 
  document.documentElement.scrollTop = 0;
}
  </script>
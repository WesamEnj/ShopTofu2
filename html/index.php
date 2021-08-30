<?php 
require('../php/setupDB.php');
?>
<html>
  <head>
  <meta charset="utf-8"/>
    <title>ShopTofu</title>

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;900&family=Raleway:wght@300;700&display=swap"
      rel="stylesheet"
    />

    <!-- styleing -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
      integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../css/styles.css" type="text/css" />

    <!-- bootstrap scripts -->
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
      integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
      integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
      crossorigin="anonymous"
    ></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/ScrollTrigger.min.js"></script>
  </head>

  <body>
    <!-- <div class="nav">
    <a href="" class="logo">ShopTofu</a>
    <a href="../html/forms/registerForm.html">Registrieren</a>
    <a href="../html/forms/loginForm.html">Anmelden</a>
  </div> -->

    <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand logo" href="#">ShopTofu</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">

        <?php 
        if(!$_SESSION["loggedIn"]){ ?>
          <li class="nav-item">
            <a class="nav-link" href="../html/forms/registerForm.html">Registrieren</a>
          </li>
          <?php } ?>

          <?php 
        
        if(!$_SESSION["loggedIn"]){ ?>
          <li class="nav-item">
            <a class="nav-link" href="../html/forms/loginForm.html">Anmelden</a>
          </li>
          <?php } ?>

          <?php 
        
        if($_SESSION["loggedIn"]){ ?>
          <li class="nav-item">
            <a class="nav-link" href="../php/logout.php">Abmelden</a>
          </li>
          <?php } ?>

          <?php 
        
        if($_SESSION["loggedIn"]){ ?>
          <li class="nav-item">
            <a class="nav-link" href="../html/basket.html">Warenkorb</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </nav>

      <div class="tofu-container">
        <div class="row">
          <div class="col-lg-6">
            <h3 class="gag">Selbst deine Katze wird's lieben!</h3>
            <h3 class="gag">Twofu Cinema Club, sicher deine fave Band!</h3>
            <h3 class="gag">Schnell, hier beginnt die Tofulution!</h3>
            <h3 class="gag">Omgggg, es ist so totally tofu!</h3>
            <h3 class="gag">
              Dildos & Tofus,<br />
              beides besser als echtes Fleisch!
            </h3>
          </div>
          <div class="col-lg-6">
            <img class="tofuWelt" src="../assets/tofu.jpg" alt="tofu" />
          </div>
        </div>
      </div>
    </div>

    <div class="middle-container">
      <div class="user-container">
        <div class="search-box">
          <input type="text" autocomplete="off" placeholder="Search Tofu..." />
          <div class="result"></div>
        </div>

        <h3 class="output">
          Hier ist die ganze Colloction. Welcome to the <span>Club</span> Shop!
        </h3>

        <div id="tofu-data" class="row text-center">
          <div class="col-lg-4 col-md-6">
            <div class="card">
              <img
                src="https://generative-placeholders.glitch.me/image?width=600&height=300&img=01"
                class="card-img-top"
                alt="..."
              />
              <div class="card-body">
                <h2 class="card-title">Tofu Name</h2>
                <h5>Price</h5>
                <p class="card-text">Descprition</p>
                <button class="btn btn-block btn-outline-dark" onClick="ani()">Will ich</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php 
        if($_SESSION["loggedIn"] && $_SESSION["email"] == 'admin@minishop.de'){ ?>
      <div class="admin-container">
        <h3>
          Hey Boss! <br />
          <a class="link" href="../html/users.html">Hier</a> sind alle User, und
          alle <a class="link" href="../html/allBaskets.html">Warenkorbe</a>.
        </h3>

        <form
      enctype="multipart/form-data"
      action="../php/article.php"
      method="post"
    >
    <label for="articleName"> <h4>Füge hier die Infos zu einem neuen Tofu ein:</h4></label>
      <input
        type="text"
        name="articleName"
        id="articleName"
        placeholder="Tofu-Name"
      />
      <input
        type="text"
        name="articlePrice"
        id="articlePrice"
        value=""
        data-type="currency"
        placeholder="€$1,000"
      />
      <input
        type="text"
        name="articleDescription"
        id="articleDescription"
        placeholder="Beschreibung"
      />
      <input
        type="file"
        name="articleImage"
        id="articleImage"
        placeholder="Bild"
      />
      <!-- <input type="submit" value="Submit" name="add" /> -->

      <button type="submit" value="Submit" name="add">Artikel adden!</button>
    </form>

      </div>
      <?php } ?>
    </div>

    <div class="bottom-container">
      <p>herz herz chris & wesam herz herz</p>
    </div>

    <script>
      /* gag */
      gags = document.getElementsByClassName("gag");
      var randomGag = gags[Math.floor(Math.random() * gags.length)];
      window.onload = function () {
        randomGag.style.display = "block";
      };

      /* All Tofus */
      var id = 0;

      var ajax = new XMLHttpRequest();
      ajax.open("GET", "../php/getGoods.php", true);
      ajax.send();
      ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          console.log(ajax);

          var html = "";
          for (var a = 0; a < data.length; a++) {
            var name = data[a].name;
            var price = data[a].price;
            var desc = data[a].description;
            
            
            html += '<div class="col-lg-4 col-md-6">';
            html += '<div class="card">';
            html +=
              '<img src="https://generative-placeholders.glitch.me/image?width=600&height=300&img=' +
              a +
              '"class="card-img-top" alt="...">';
            html += '<div class="card-body">';
            html += '<h2 class="card-title">' + name + "</h2>";
            html += "<h5>" + price + "</h5>";
            html += '<p class="card-text">' + desc + "</p>";
            html +=
              "<button id=" +
              (a+1) +
              ' class="btn btn-block btn-outline-dark" onClick="buyTofuBtn(this.id)">Will ich</button>';
            html += "</div>";
            html += "</div>";
            html += "</div>";

            /*.onclick = function () {

          };*/
          }
          
          document.getElementById("tofu-data").innerHTML += html;
          gsap.from(".card", {
            scrollTrigger: ".card",
            duration: 1,
            x: 2000,
            ease: "bounce",
            stagger: 0.5,
          });
        }
      };

      function buyTofuBtn(id) {
        ani();
        var btn = new XMLHttpRequest();
        var url = "../php/order.php";
        var post = 'id='+id+'&addArticle=true';
        btn.open("POST", url, true);
        btn.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        btn.send(post);
      }
      /* Search */
      $(document).ready(function () {
        $('.search-box input[type="text"]').on("keyup input", function () {
          var inputVal = $(this).val();
          var resultDropdown = $(this).siblings(".result");
          if (inputVal.length) {
            $.get("../php/search.php", {
              term: inputVal,
            }).done(function (data) {
              resultDropdown.html(data);
            });
          } else {
            resultDropdown.empty();
          }
        });

        $(document).on("click", ".result p", function () {
          $(this)
            .parents(".search-box")
            .find('input[type="text"]')
            .val($(this).text());
          $(this).parent(".result").empty();
        });
      });

      /* Chris Code */
      $("input[data-type='currency']").on({
        keyup: function () {
          formatCurrency($(this));
        },
        blur: function () {
          formatCurrency($(this), "blur");
        },
      });

      function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }

      function formatCurrency(input, blur) {
        var input_val = input.val();

        input_val = formatNumber(input_val);
        input_val = "€$" + input_val;
        input.val(input_val);
      }

      /* GSAP */
      gsap.from(".admin-container", {
        scrollTrigger: ".admin-container",
        duration: 2,
        ease: "expo",
        y: 200,
      });
      gsap.from("form", {
        scrollTrigger: {
          trigger: ".admin-container",
          start: "top center ",
        },
        duration: 5,
        ease: "elastic",
        y: 200,
      });
      var output = document.querySelector(".output");

    function ani() {
      gsap.from(".user-container", {
        duration: .7,
        x: 800,
        stagger: 0.1,
        ease: "elastic",
        onComplete: showMessage,
        onCompleteParams: ["done!"]
      });
    };

    function showMessage(message) {
      output.innerHTML += message + "</br>";
    };
    
    </script>
  </body>
</html>



    <footer class="footer">
        <div class="footer__addr">
          <h1 class="footer__logo">SBTC</h1>
              Liên hệ</h2>

          <address>
            duognthangpt3011@gmail.com<br>
           ngothanhcanh2002@gmail.com<br>
            levanthuan2209@gmail.com<br>
            <a class="footer__btn" href="about.php" style="position: absolute;">contract Us</a>
          </address>
          
        </div>
        
        <ul class="footer__nav">
          <li class="nav__item">
            <h2 class="nav__title">Thư viện</h2>
      
            <ul class="nav__ul">
              <li>
                <a href="#">SwiperJs</a>
              </li>
      
              <li>
                <a href="#">SweetAlert</a>
              </li>
                  
              <li>
                <a href="#">Some litle libary</a>
              </li>
            </ul>
          </li>
          
          <li class="nav__item nav__item--extra">
            <h2 class="nav__title">Công nghệ</h2>
            <ul class="nav__ul nav__ul--extra">
              <li>
                <a href="#">HTML</a>
              </li>
              
              <li>
                <a href="#">CSS</a>
              </li>
              
              <li>
                <a href="#">JavaScript</a>
              </li>
              <li>
                <a href="#">PHP</a>
              </li>
              
              <li>
                <a href="#">Ajax</a>
              </li>
            </ul>
          </li>
          <div class="footer_bg">
          <div class="footer_bg_one"></div>
          <div class="footer_bg_two"></div>
      </div>
          <li class="nav__item">
            <h2 class="nav__title">Tính hợp pháp</h2>
            
            <ul class="nav__ul">
              <li>
                <a href="#">Chính sách bảo mật</a>
              </li>
              
              <li>
                <a href="#">Điều khoản sử dụng</a>
              </li>
              
              <li>
                <a href="#">Sơ đồ trang web</a>
              </li>
            </ul>
          </li>
        </ul>
        
        <div class="legal">
          <p>&copy; 2023 Cuộc thi website UPT.</p>
          
          <div class="legal__links">
            <span>Made with <span class="heart">♥</span> SBTC team</span>
          </div>
        </div>

       
      </footer>
     
      <style>
        *, *:before, *:after {
    box-sizing: border-box;
    
  }
  
  .line_quoclo{
    
  }
  

  
  .footer {
    font-family: acumin-pro, system-ui, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    flex-flow: row wrap;
    padding: 30px 30px 20px 30px;
    color: #2f2f2f;
    background-color: #fff;
    border-top: 1px solid #e5e5e5;
    background: url("https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEigB8iI5tb8WSVBuVUGc9UjjB8O0708X7Fdic_4O1LT4CmLHoiwhanLXiRhe82yw0R7LgACQ2IhZaTY0hhmGi0gYp_Ynb49CVzfmXtYHUVKgXXpWvJ_oYT8cB4vzsnJLe3iCwuzj-w6PeYq_JaHmy_CoGoa6nw0FBo-2xLdOPvsLTh_fmYH2xhkaZ-OGQ/s16000/footer_bg.png") no-repeat scroll center 0;
    width: 100%;
    height: 300px;

  }
  .footer_bg_one{
    background: url("image/car.gif");
    width: 100px;
    height: 105px;
  background-size:100%;
    position: absolute;
    bottom: 0;
    left: 30%;
    -webkit-animation: myfirst 22s linear infinite;
    animation: myfirst 22s linear infinite;
  }

  
  .footer > * {
    flex:  1 100%;
  }
  
  .footer__addr {
    margin-right: 1.25em;
    margin-bottom: 2em;
  }
  
  .footer__logo {
    font-family: 'Pacifico', cursive;
    font-weight: 400;
    text-transform: bold;
    font-size: 1.5rem;
  }
  
  .footer__addr h2 {
    margin-top: 1.3em;
    font-size: 15px;
    font-weight: 400;
  }
  
  .nav__title {
    font-weight: 400;
    font-size: 15px;
  }
  
  .footer address {
    font-style: normal;
    color: #999;
  }
  
  .footer__btn {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 36px;
    max-width: max-content;
    background-color: rgb(33, 33, 33, 0.07);
    border-radius: 100px;
    color: #2f2f2f;
    line-height: 0;
    margin: 0.6em 0;
    font-size: 1rem;
    padding: 0 1.3em;
  }
  
  .footer ul {
    list-style: none;
    padding-left: 0;
  }
  
  .footer li {
    line-height: 2em;
  }
  
  .footer a {
    text-decoration: none;
  }
  
  .footer__nav {
    display: flex;
      flex-flow: row wrap;
  }
  
  .footer__nav > * {
    flex: 1 50%;
    margin-right: 1.25em;
  }
  
  .nav__ul a {
    color: #999;
  }
  
  .nav__ul--extra {
    column-count: 2;
    column-gap: 1.25em;
  }
  
  .legal {
    display: flex;
    flex-wrap: wrap;
    color: #999;
  }
  .legal p{
    margin-top: 18px;
  }
  .legal__links {
    display: flex;
    align-items: center;
  }
  
  .heart {
    color: #2f2f2f;
  }
  
  @media screen and (min-width: 24.375em) {
    .legal .legal__links {
      margin-left: auto;
    }
  }
  
  @media screen and (min-width: 40.375em) {
    .footer__nav > * {
      flex: 1;
    }
    
    .nav__item--extra {
      flex-grow: 2;
    }
    
    .footer__addr {
      flex: 1 0px;
    }
    
    .footer__nav {
      flex: 2 0px;
    }
  }




@-moz-keyframes myfirst {
  0% {
    left: -25%;
  }
  100% {
    left: 90%;
  }
}

@-webkit-keyframes myfirst {
  0% {
    left: -25%;
  }
  100% {
    left: 90%;
  }
}

@keyframes myfirst {
  0% {
    left: -25%;
  }
  100% {
    left: 90%;
  }
}

      </style>


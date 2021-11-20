<style>

section
{
    padding: 0 164px;
}
label #btn,
label #cancel{
    color: white;
    font-size: 30px;
    float: right;
    line-height: 80px;
    margin-right: 40px;
    cursor: pointer;
    display: none;
}
#check{
    display: none;
}
.banner img{
    width: 100%;
    padding: 5px 0;

}

/* tab */

/* Style the tab */
.wid{
    width: 100%;
    /* display: block; */
    align-items: center;
    display: flex;
    justify-content: center;
    opacity: 0;

}
.tab {
    float: left;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 15%;
    height: auto;
  }

  /* Style the buttons that are used to open the tab content */
  .tab button {
    display: block;
    background-color: inherit;
    color: black;
    padding: 22px 16px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current "tab button" class */
  .tab button.active {
    background-color: #ccc;
  }

  /* Style the tab content */
  .tabcontent {
    float: left;
    padding: 0px 12px;
    border: 1px solid #ccc;
    width: 59%;
    border-left: none;
    height: auto;
    display: none;
    min-height: 178px;
  }
  .container {
    position: relative;
    max-width: 100%; /* Maximum width */
    margin: 0 auto; /* Center it */
  }

  .container .content {
    position: absolute; /* Position the background text */
    bottom: 0; /* At the bottom. Use top:0 to append it to the top */
    background: rgb(0, 0, 0); /* Fallback color */
    background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
    color: #f1f1f1; /* Grey text */
    width: 100%; /* Full width */
    padding: 50px 0; /* Some padding */
  }
  .container .content .category a{

      padding: 2px;
      color: white;
      font-size: 10px;
      margin-left: 5px
;
  }

.container .content a{

    padding: 2px;
    color: white;
    font-size: 24px;
    margin-left: 5px;
    font-weight: 700;;
}
.container .content a:hover{
    color: red;
}


.container img {
  width: 100%;
  transition: all 1s;
}

.banner:hover img {
    -webkit-transform: scale(1.0);
            transform: scale(1.3);
            transition: 3s;
}
.banner:hover .content{
   width: 102% !important;
   transition: 3s;
}
.cont{
    overflow: hidden;
}
.cont:hover img{
    -webkit-transform: scale(1.0);
            transform: scale(1.2);
            transition: all 1s;
}
.containerii{
    display: flex;
    justify-items: center
}
.containerii {
    position: relative;
    max-width: 100%; /* Maximum width */
    margin: 0 auto; /* Center it */
  }

  .containerii  .container .content {
    position: absolute; /* Position the background text */
    bottom: 0; /* At the bottom. Use top:0 to append it to the top */
    background: rgb(0, 0, 0); /* Fallback color */
    background: rgba(0, 0, 0, 0.5); /* Black background with 0.5 opacity */
    color: #f1f1f1; /* Grey text */
    width: 100%; /* Full width */
    padding: 17px 0; /* Some padding */
  }
  .containerii .container .content a,p{

      padding: 2px;

      font-size: 14px;
    margin-left: 5px;
  }
  .containerii{
    /* border: 1px solid #CCC; */
    padding: 5px 0;
    height: auto;
    margin: 10px auto;
    overflow: hidden; /** DÒNG BẮT BUỘC CÓ **/
    position: relative;

}

.container img {
  width: 100%;
  transition: all 1s;
}


.op1{
    padding-right: 5px;

}
.op2{
    padding-left: 5px;
}


/* newpaper */
.newtt{
    width: 100%;
    display: flex;
}
.col{
    display: flex;
    padding: 5px;
    width: 96%;

}
.col img{
    width: 100%;

}
.col a,p{
    padding: 5px;

}
.cont{
    width: 35%;
}


.car{
    width: 67%;
    padding-left: 20px;
}
.car a{
    color: black;
    font-weight: 700;
}
.car a:hover{
    color: crimson;
}

.ad {
    width: 78%;
}
.ad img{
    width: 100%;
}

.ad p{

    text-align: center;
    color: rgb(253, 253, 253);
    background: rgb(0, 0, 0);
    padding: 5px 30px;
    margin-left: 0px;
}

.en{
    min-height: 60vh;
    background-color: black;
    color: blanchedalmond;
    display: flex;
    justify-items:center;

    padding: 43px;
}
.hot{
    width: 30%;
    padding: 0 32px;
}
.hpp {
    height: 105px;
    margin-bottom: 5px;
    border-bottom: solid 1px#ffffff33;
}



.hpp img{
    width: 131%;
    float: left;
}
.opp1{
    width: 35%;
}
.opp2 {
    width: 52%;
    padding: 6px 5px;
    margin-left: 182px;
}
.opp2 a{
    color: white
}
.opp2 p{
    color: rgb(158, 26, 26)
}
.opp2 a:hover{
    color: rgb(139, 20, 20)
}
.new{
    width: 30%;
}
.view{
    width: 34%;

}
.list{
    margin: 30px 0;
    display: flex;
    justify-content: space-between;
}
.list a{
    padding: 0 74px;
    padding: 0 74px;
    text-decoration: none;
    color: white;
}
.list a:hover{
    color: red;
}


@media (max-width:860px){


    #check:checked ~ label #btn{
        display: none;
    }
    #check:checked ~ label #cancel{
        display: block;
    }

    .en {
        min-height: 60vh;
        background-color: black;
        color: blanchedalmond;
        display: block;
        justify-items: center;
        padding: 43px;
    }
    section {
        padding: 0 0;
    }
    .newtt {
        width: 100%;
        display: block;
    }
    .ad {
        width: 100%;
    }
    .hot {
        width: 95%;
        padding: 0 5px;
    }
    .en {
        min-height: 60vh
    ;
        background-color: black;
        color: blanchedalmond;
        display: block;
        justify-items: center;
        padding: 0px;
    }
    .new {
        width: 95%;
        padding: 0 5px;
    }
    .view {
        width: 100%;
    }
    .opp2 {
        width: 52%;
        padding: 6px 0px;
        margin-left: 182px;
    }
    .list {
        margin: 0px
     0;
        display: flex;
    justify-content: space-between;
    }
    .list a {
        padding: 0 0;
        margin: 10px 63px;
        text-decoration: none;
        color: white;
    }
    .col {
        display: flex;
        padding: 5px;
        width: 96%;
    }
    .car p{
        display: none;
    }
    .content .more {
        text-align: center;
        padding: 32px;
    }
    .ad p {
        text-align: center;
        color: rgb(253, 253, 253);
        background: rgb(0, 0, 0);
        padding: 10px 30px;
        margin-left: 0px;
        margin: 18px 58px;
    }

    .container .content {
        position: absolute;
        bottom: 0;
        background: rgb(0, 0, 0);
        background: rgba(0, 0, 0, 0.5);
        color: #f1f1f1;
        width: 100%;
        padding: 0 0;
    }
    .ennd {
        width: 100%;
        height: 48vh;
        background-color: black;
        align-items: center;
        justify-items: center;
    }


}
</style>
<section>
        <div class="containerii">
            <div class="op1">
                <div class="container banner">
                    <img src="{{asset('assets/images/posts')}}/{{$post_new->image}}" alt="">
                    <div class="content">
                     <h1><a href="{{ route('post',['post_slug'=>$post_new->slug])}}">{{$post_new->title}}</a></h1>
                      <p>Post By: {{$post_new->author}} - {{$post_new->created_at}}</p>
                    </div>
                  </div>
            </div>

        </div>
    </section>
    <section><h1 class="" style="border-bottom: 1px solid red; width: 100%; padding: 5px 0;">MỚI CẬP NHẬT</h1></section>
    <section>
        <div class="newtt">


            <div class="content">

                @foreach ($posts as $post)
                <div class="col">
                <div class="cont product-thumnail" style="margin-right:0;">
                    <figure>
                        <img src="{{asset('assets/images/posts')}}/{{$post->image}}" alt="">

                    </div>
                    <div class="car">
                    <a href="{{ route('post',['post_slug'=>$post->slug])}}">{{$post->title}}</a>
                        <p style="color: crimson;">Post By: {{$post->author}}</p>
                        <p style="color: black;">{{$post->short_desc}}</p></div>
                    </div>

                @endforeach
                {{ $posts->links('livewire-pagination-link') }}
            </div>

            <div class="ad">
                <img src="{{asset('assets/images/sliders')}}/{{$new_product_banner->image}}" alt="">
            </div>
        </div>

</section>


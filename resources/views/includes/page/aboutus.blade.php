<section class="about-section sec-pad bg-color-1">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                <div class="content_block_1">
                    <div class="content-box">
                        <div class="sec-title">
                            <h6><i class="flaticon-star"></i><span>WHY IT MATTERS</span></h6>
                            <h2>{{$aboutContent->page_title}}</h2>
                            <div class="title-shape"></div>
                        </div>
                        <div class="text">  <?php echo $aboutContent->page_content ; ?>  </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                <div class="image_block_1">
                    <div class="image-box">
                        <figure class="image"><img style="width: 510px; height: 605px" src="{{asset('page_image/'.$aboutContent->image)}}" alt=""></figure>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@php
    use Carbon\Carbon;
@endphp


@if (!empty($result->blogs->toArray()))
    <section id="BlogVideo" class="blogvideo_main_section">

        <div class="blogvideo">
            <h2 class="heading_program_details">{{ trans('front_messages.global.blog') }}</h2>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link video_blogtab active" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile-tab-pane" type="button" role="tab"
                        aria-controls="profile-tab-pane" aria-selected="false">{{ trans('front_messages.global.blog') }}</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                
                <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel"
                    aria-labelledby="profile-tab" tabindex="0">
                    <div class="slider blog_video_crousel">
                        @foreach ($result->blogs as $blogs)  
                            
                            @php
                                $date = Carbon::parse($blogs->created_at);
                                $formattedDate = $date->format('M d, Y');
                            @endphp  

                            <div>
                                <div class="blog_video_content">
                                    <ul>
                                        <li>
                                            <div class="card blog_video_inner_content">
                                                <figure>
                                                    

                                                    <?php
                                                        echo $image = CustomHelper::showImage(BLOG_IMAGE_ROOT_PATH, BLOG_IMAGE_URL, $blogs->image, '', ['alt' => $blogs->image, 'height' => '119', 'width' => '281', 'zc' => 2]);
                                                    ?>
                                                </figure>
                                                <div class="card-body">
                                                    <h5><a href="{{ route('Blog.postView', $blogs->slug) }}">{{ CustomHelper::getStringLimit($blogs->title, 15) }}</a> </h5>
                                                    <span>{{ $formattedDate }}</span>
                                                </div>
                                                <div class="card-footer blogvideo_btn">
                                                    <a href="{{ route('Blog.postView', $blogs->slug) }}" class="btn btn-outline-primary">{{ trans('front_messages.global.read_more') }}</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif



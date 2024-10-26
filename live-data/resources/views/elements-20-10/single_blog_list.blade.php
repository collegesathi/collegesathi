<div class="card">

    @php
    $root_path = BLOG_IMAGE_ROOT_PATH;
    $http_path = BLOG_IMAGE_URL;
    $attribute = [];
    $type = '';
    $attribute['alt'] = $blogData->title;
    $attribute['width'] = '298';
    $attribute['height'] = '177';
    $attribute['zc'] = '1';
    $attribute['type'] = '3';
    $image_name = $blogData->image;

    $image = CustomHelper::showImage($root_path, $http_path, $image_name, $type, $attribute);
    @endphp


    <figure>
        <a href="{{ route('Blog.postView', $blogData->slug) }}">
            {!! $image !!}
        </a>
    </figure>
    <div class="card-body">

        <h4 class="card-title"><a href="{{ route('Blog.postView', $blogData->slug) }}">{{ isset($blogData->title) ? $blogData->title : 'N/A' }}</a></h4>
        <div class="author_details">
            @php
            if (isset($blogData->addedByUser->user_role_id) && $blogData->addedByUser->user_role_id == SUPER_ADMIN_ROLE_ID) {
            $addedBy = 'Admin';
            } else {
            $addedBy = $blogData->addedByUser->full_name;
            }

            $created_at = CustomHelper::convert_date_to_timestamp($blogData->created_at);
            $blogDate = date(BLOG_DETAIL_DATE_FORMAT, $created_at);

            @endphp

            <span>by <a href="javascript:void(0);">{{ $addedBy }}</a> </span> <span>-
                {{ $blogDate }}</span>
        </div>
        @php
        $description = isset($blogData->descriptionData->description) ? trim($blogData->descriptionData->description) : '';
        $description = !empty($description) ? strip_tags($description) : '';
        $description = !empty($description) ? Str::limit($description, BLOG_LIST_DESCRIPTION_LENGTH) : '';
        @endphp
        <p>{!! $description !!}</p>
        <div class="blog_banner_icon">
            <div class="blog_btnbox content_btn pt-0">
                <a href="{{ route('Blog.postView', $blogData->slug) }}" class="btn-link">
                    {{ trans('front_messages.global.read_more') }}</a>
            </div>
            <div class="icon d-flex latest_postsicon share-wrapper">
                <figure>
                    <a href="javascript:void(0);">
                        <img class="share_icon d-inline-flex" src="{{ WEBSITE_IMG_URL }}share_network_icon.svg" alt="">
                        <!--<img class="share_icon_white share" src="{{ WEBSITE_IMG_URL }}share_network_icon_white.svg" alt="">-->
                    </a>

                </figure>

                <div class="share-btns">
                    <a target="_blank" href="https://www.facebook.com/sharer.php?u={{ route('Blog.postView', $blogData->slug) }}&amp;t={{ $blogData->title }}"><i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i>
                    </a>
                    <a target="_blank" href="https://twitter.com/home/?status={{ $blogData->title }} - {{ route('Blog.postView', $blogData->slug) }}"><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i>
                    </a>
                    <a target="_blank" href="https://www.instagram.com/?url={{ route('Blog.postView', $blogData->slug) }}"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i>
                    </a>
                    <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('Blog.postView', $blogData->slug) }}&amp;title={{ $blogData->title }}"><i class="fa fa-linkedin fa-2x" aria-hidden="true"></i>
                    </a>
                    <a target="_blank" href="https://api.whatsapp.com/send?text=The text to share!={{ route('Blog.postView', $blogData->slug) }}&amp;title={{ $blogData->title }}"><i class="fa fa-whatsapp fa-2x" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
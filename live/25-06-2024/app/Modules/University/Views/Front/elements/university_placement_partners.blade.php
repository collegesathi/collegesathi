@if (!empty($result->getUniversityPlacementPartners))
    @foreach (explode(',', $result->getUniversityPlacementPartners->university_placement_partners) as $placementPartners)
        <?php
        $placementPartnersImages = CustomHelper::getFieldValueByFieldName($placementPartners, 'id', 'DropDown', 'image', 'DropDown');
        
        $placementPartnersName = CustomHelper::getMasterDropdownNameById($placementPartners);
        ?>
        <div class="approved_logo_box">
            <div class="approved_logo">
                <figure>
                    <?php
                    echo $image = CustomHelper::showImage(DROPDOWN_IMAGE_ROOT_PATH, DROPDOWN_IMAGE_URL, $placementPartnersImages, '', ['alt' => $placementPartnersImages, 'height' => '77', 'width' => '100', 'zc' => 0]);
                    ?>
                </figure>
                <div class="logo_details">
                    <h5>{{ $placementPartnersName }}</h5>
                </div>
            </div>
        </div>
    @endforeach
@endif

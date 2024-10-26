<?php
if (!empty($universities)) {
?>  
    <section class="universities">
        <div class="universitiesWidth">
            <?php
            foreach ($universities as $key => $value) {
            ?>
                <div class="item universities-item">
                    <figure class="universitieslogo">
                        <img src="{{ UNIVERSITY_IMAGE_URL . $value['image'] }}" alt="{{ $value['image'] }}" height="41">
                    </figure>
                </div>
            <?php
            }
            ?>
        </div>
    </section>
<?php
}
?>   
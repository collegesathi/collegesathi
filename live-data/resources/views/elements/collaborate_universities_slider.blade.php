<?php
if (!empty($universities)) {
?>  
    <section class="uni-logos my-3" style="height: 69px;">
        <div class="logos-list">
            <?php
            // Display logos twice to create a continuous effect
            foreach ($universities as $key => $value) {
            ?>
            <div class="logo-items">
                <img src="{{ UNIVERSITY_IMAGE_URL . $value['image'] }}" alt="uni-logo" height="41">
            </div>
            <?php } ?>

            <!-- Repeat logos again for the continuous effect -->
            <?php
            foreach ($universities as $key => $value) {
            ?>
            <div class="logo-items">
                <img src="{{ UNIVERSITY_IMAGE_URL . $value['image'] }}" alt="uni-logo" height="41">
            </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>


<style>
.uni-logos {
    width: 100%;
    overflow: hidden;
    padding: 20px 0;
    background-color: #f9f9f9; /* optional: background color */
}

.logos-list {
    display: flex;
    /* align-items: center; */
    justify-content: flex-start; /* Use flex-start for a smooth scroll */
    animation: scroll 40s linear infinite; /* Slower speed */
}

.logo-items {
    flex: 0 0 auto;
    padding: 10px;
    margin: -21px 20px;
}

.logo-items img {
    max-width: 150px;
    height: auto;
}

/* Keyframes for the marquee scrolling effect */
@keyframes scroll {
    0% {
        transform: translateX(0); /* Start from the left */
    }
    100% {
        transform: translateX(-50%); /* Move left to half of the container */
    }
}

/* Responsiveness */
@media (max-width: 768px) {
    .logos-list {
        animation-duration: 30s; /* Slower for medium screens */
    }
    .logo-items img {
        max-width: 120px;
    }
}

@media (max-width: 480px) {
    .logos-list {
        animation-duration: 20s; /* Slower for smaller screens */
    }
    .logo-items img {
        max-width: 100px;
    }
}
</style>

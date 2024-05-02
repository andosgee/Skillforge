<div class="marquee">
    <div class="marquee__wrapper">
        <?php 
            $images = ["image1.jpg", "image2.jpg", "image3.jpg", "image4.jpg", "image5.jpg", "image6.jpg"];

            foreach ($images as $image) {
                echo '<img src="assets/image/assets/marquee/'. $image .'">';
            }
        ?>
    </div>
    <div class="marquee__controls">
            <button class="button__prev">&#10094;</button>
            <button class="button__next">&#10095;</button>
    </div>
    <div class="marquee__selector">
            <?php
            // Output thumbnails or dots for each slide
            foreach ($images as $index => $image) {
                echo '<div class="marquee__selector__image" data-index="assets/image/assets/marquee/' . $index . '"></div>';
            }
            ?>
        </div>
    
</div>
<script src="js/marquee.js"></script>
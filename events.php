<section class="page-section bg-dark" id="events">
     <div class="container">
         <h2 class="text-center">Events</h2>
         <div class="d-flex w-100 justify-content-center">
             <hr class="border-warning" style="border:3px solid" width="15%">
         </div>
         <div class="w-100">
             <?php
             $events = $conn->query("SELECT * FROM `events` ORDER BY rand()");
             while ($row = $events->fetch_assoc()):
                 $video_path = $row['video_path'];
                
                 $row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));
                 // $review = $conn->query("SELECT * FROM `rate_review` WHERE event_id='{$row['id']}'");
                 // $review_count = $review->num_rows;
                 // $rate = 0;
                 // while ($r = $review->fetch_assoc()) {
                     // $rate += $r['rate'];
                 // }
                 // if ($rate > 0 && $review_count > 0)
                 // if ($rate == 0)
                     // $rate = number_format($rate / $review_count, 0, "", "");
             ?>
                 <div class="card d-flex w-100 rounded-0 mb-3 event-item">
                     <video class="card-img-top" controls height="200rem" style="object-fit:cover">
                         <source src="<?php echo $video_path ?>" type="video/mp4">
                         Your browser does not support the video tag.
                     </video>
                     <div class="card-body">
                         <h5 class="card-title truncate-1"><?php echo $row['title'] ?></h5>
                         <!-- <div class="w-100 d-flex justify-content-start">
                             <form action="">
                                 <div class="stars stars-small">
                                     <input disabled class="star star-5" id="star-5" type="radio" name="star" <?php // echo $rate == 5 ? "checked" : '' ?>/> <label class="star star-5" for="star-5"></label> 
                                     <input disabled class="star star-4" id="star-4" type="radio" name="star" <?php // echo $rate == 4 ? "checked" : '' ?>/> <label class="star star-4" for="star-4"></label> 
                                     <input disabled class="star star-3" id="star-3" type="radio" name="star" <?php // echo $rate == 3 ? "checked" : '' ?>/> <label class="star star-3" for="star-3"></label> 
                                     <input disabled class="star star-2" id="star-2" type="radio" name="star" <?php // echo $rate == 2 ? "checked" : '' ?>/> <label class="star star-2" for="star-2"></label> 
                                     <input disabled class="star star-1" id="star-1" type="radio" name="star" <?php // echo $rate == 1 ? "checked" : '' ?>/> <label class="star star-1" for="star-1"></label> 
                                 </div>
                             </form>
                         </div> --><p class="card-text truncate"><?php echo $row['description'];?></p>
                         <!-- <div class="w-100 d-flex justify-content-between">
                             <span class="rounded-0 btn btn-flat btn-sm btn-primary"><i class="fa fa-tag"></i> <?php // echo number_format($row['cost']) ?></span>
                             <a href="./?page=view_event&id=<?php //echo md5($row['id']) ?>" class="btn btn-sm btn-flat btn-warning">View Event <i class="fa fa-arrow-right"></i></a>
                         </div> -->
                     </div>
                 </div>
             <?php endwhile; ?>
         </div>
     </div>
 </section>
 
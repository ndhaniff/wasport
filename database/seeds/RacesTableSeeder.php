<?php

use Illuminate\Database\Seeder;

class RacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('races')->insert([
            'title' => '21Day Challenge Sep 2018',
            'date_from' => '2018-08-17 00:00 am',
            'date_to' => '2018-08-21 00:00 am',
            'dead_from' => '2018-08-09 00:00 am',
            'dead_to' => '2018-08-16 00:00:00 am',
            'price' => 122.00,
            'about' => "<p>Welcome to the September 21 Day Challenge – Virgo!</p><p><br></p><p>Virgos are the perfect blend of perfectionism and pragmatism. Although they set sky-high expectations for themselves, they remain grounded by working towards achievable, short-term targets. </p><p><br></p><p>This 21 Day Challenge, don’t be afra <span style=\"color: rgb(205, 19, 19);\">Read More...</span></p><h2><img src=\"https://virtual-race-submissions.s3-ap-southeast-1.amazonaws.com/images/MEDAL-BANNER-1d-gif-uab10082018-105503\" alt=\"21Day Challenge Sep 2018 medal\"></h2><p><img src=\"https://virtual-race-submissions.s3-ap-southeast-1.amazonaws.com/images/MEDAL-BANNER-1D-jpg-9fs10082018-105503\" alt=\"21Day Challenge Sep 2018 medal\"></p><p><img src=\"https://virtual-race-submissions.s3-ap-southeast-1.amazonaws.com/images/MEDAL-BANNER-2D-jpg-su910082018-105503\" alt=\"21Day Challenge Sep 2018 medal\"></p><p><img src=\"https://virtual-race-submissions.s3-ap-southeast-1.amazonaws.com/images/MEDAL-BANNER-3D-jpg-k2b08082018-145930\" alt=\"21Day Challenge Sep 2018 medal\"></p><p><img src=\"https://virtual-race-submissions.s3-ap-southeast-1.amazonaws.com/images/MEDAL-BANNER-4A-jpg-pzf09082018-142436\" alt=\"21Day Challenge Sep 2018 medal\"></p><p><br></p><p><span class=\"ql-cursor\">﻿</span>Medals</p><p>Virgo’s element is the Earth. Our medal reflects this, showing her relaxing peacefully among the beautiful elements of nature. As we run to improve ourselves, let's remember not to get too caught up in the competition. Stop &amp; smell the flowers along the way! (:  </p>",
            'awards' => "<p>Get a chance to win these cool prizes when you register</p><h2><img src=\"https://virtual-race-submissions.s3-ap-southeast-1.amazonaws.com/images/icrossedline-meitu-13-jpg-3az21062017-160444\" width=\"100%\">Inspirational Awards x 3</h2><p>Metallic Double Layer Medal Hanger </p><p>(worth S$59.90)</p><p>Material: Metal</p><p>Nett weight: 480g</p><p>Size: 48cm x 17.4cm</p><h2><img src=\"https://virtual-race-submissions.s3-ap-southeast-1.amazonaws.com/images/gift-box-01-jpg-ffi14062017-174812\" width=\"100%\">Lucky Draw Winners x 50</h2><p>Runner's Gift Set (worth S$29.90)</p><p>2018 Serial Challenge Award</p><p>There are 3 types of special awards for our 2018 21Day challenges. The following awards are given to all who satisfy the respective criteria. Limited to one award per person. Grand Slam/Super Runner medal photo is for reference only, actual product might slightly differ.</p><p><img src=\"https://virtual-race-submissions.s3-ap-southeast-1.amazonaws.com/images/MEDAL-BANNER-GRAND-SLAM-AWARD-1-jpg-q2r13022018-91136\">Grand Slam Award</p><p>Complete 12 challenges with min of 100km for each challenge</p><p>Awards</p><p>1.&nbsp;Special Grand Slam Finisher’s Medal&nbsp;</p><p>2.&nbsp;Hall of Fame&nbsp;</p><p>3.&nbsp;Invitation to 2018 year end celebration party (in Singapore)</p><p>Super Runner Award</p><p>Complete 9 challenges with min of 20km for each challenge</p><p>Awards</p><p>1.&nbsp;Special Super Runner Finisher’s Medal&nbsp;</p><p>2.&nbsp;Hall of Fame&nbsp;</p><p>3.&nbsp;Invitation to 2018 year end celebration party (in Singapore)</p><p>Power Runner Award</p><p>Complete 6 challenges with min of 20km for each challenge</p><p>Awards</p><p>1.&nbsp;Hall of Fame</p>",
            'header' => 'WEB BANNER  1900x1000_1534488318.jpg',
      ]);
    }
}

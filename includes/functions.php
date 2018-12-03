<?php
include 'connect.php';

function get_single_video($pdo, $vid) {
    // $query = "SELECT video.*, genre.* FROM video JOIN genre ON genre.genre_id = video.id WHERE id = '$vid'";
    $query = "SELECT * FROM video WHERE id = '$vid'";

    $get_video = $pdo->query($query);
    $results = array();

    while($row = $get_video->fetch(PDO::FETCH_ASSOC)) {
        $subquery = "SELECT * FROM genre WHERE id = '$vid' AND genre_id =".$row['id'];
        //echo $subquery;
        $get_genre = $pdo->query($subquery);
        while($row1 = $get_genre->fetch(PDO::FETCH_ASSOC)) {
                $results[] = array_merge($row, $row1);
        // you could run subresult queries here - just write another function and append.
        }
    }
    return $results;

}

function get_all_videos($pdo) {
    // $query = "SELECT video.*, genre.genre FROM video JOIN genre ON genre.genre_id = video.id";
    $query = "SELECT * FROM video";

    $get_video = $pdo->query($query);
    $results = array();
    while($row = $get_video->fetch(PDO::FETCH_ASSOC)) {
        //$results[] = $row;
        // print_r($row);
        // exit();
        $subquery = "SELECT * FROM genre WHERE genre_id =".$row['id'];
        //echo $subquery;
        $get_genre = $pdo->query($subquery);
        //$results1 = array(); 
        while($row1 = $get_genre->fetch(PDO::FETCH_ASSOC)) {
            //$results1[] = $row1;
           // if($row1['genre_id'] == $row['id']){
                $results[] = array_merge($row, $row1);
           // }
        }
        //$results2 = array_merge($results, $results1);
        // $finalresults = array();
        // foreach($results2 as $key => $value){
        //     $finalresults[$value['id']][]= $value;
        // }
    }

    return $results;
}


 //    foreach($results as $key => $value) {
    //        foreach($results1 as $k => $v) {
    //            if($value[$key]['vid_genre'] == $v[$k]['genre_id']){
    //                $results[$key]['k'][] = $results1[$k];
    //            }
    //        }
    //        return $results;
    //    }
//     foreach($results as &$item){
//         foreach($results1 as $results2) {
//             if($item['vid_genre'] == $results2['genre_id']){
//                 $item['k'][] = $results2;
//             }
//         }
//     }
//     return $results;
// }
?>
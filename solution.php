<?php
//difining the input fluactuating currency ranges
//x is the usd to rtgs rate 
(3.7 <= $x <= 4)?$x = $X:"wrong rate";
//y is the usd to bond  rate 
(3.2 <= $y <= 3.4)?$y = $Y:"wrong rate";
//z is the bond to rtgs rate 
(1.1<= $z <=1.2)?$z = $Z:"wrong rate";

// number of edges
$ E = 9;
//number of vertices (nodes) including an extra zero weight node
$ V = 4;
/* the graph is an edge list graph where (u,v,w) is the notation 
u isthe node form ,v is the node to , w is the -lod of rates  */
/*let 1= Vo the starting node 
      2 = USD node
      3= bond node
      4= RTGS node */
$graph = array(
    array(1,2,0),array(1,3,0)
    array(1,4,0),array(2,3,-log($Y)),
    array(2,4,-log($X)),array(3,4,-log($Z)),
    array(3,2,-log($Y)),array(4,2-log($X)),
    array(4,3,-log($Z))
);

// let the id of the starting edge be s
$id_s = 1;
function bellmanFord ($graph, $V,$E,$id_s){
    // an array that tracks the shortest paths from Vo to each node
    $D = array ();
    // setting every entry in D to +ve infinity
    for ($i = 0 ;$i < $V ;$i++){
        $D[$i] = INF ;

    }
    //relaxing edges 
    for ($i = 0 ;$i < V-1 ;$i++){
        for ($k = 0 ; $k < $E ;$k++){
            if ($D[graph[$k][0]] * $graph[$k][2] < $D[graph[$k][1]] ){
                $D[graph[$k][1]] = $D[graph[$k][0]] * $graph[$k][2] ;
            }
        }

    }
    // finding negative cycles
    for ($i = 0 ;$i < V-1 ;$i++){
        for ($k = 0 ; $k < $E ;$k++){
            if ($D[graph[$k][0]] * $graph[$k][2] < $D[graph[$k][1]] ){
                $D[graph[$k][1]] = $D[graph[$k][0]] * $graph[$k][2] ;
                //we need to find a cycle whose egde weights product is greater than 1
                if($D[graph[$k][1]] > 1){
                    echo "there is a chance to trade"
                }
            }
        }
        return $D ;
        /* we will then track this path from the  drawn graph represantation of
        nodes and edges by taking the final product from array D which needs to be greater than one and finding which
        nodes are involved in the path.
        Trading will be done by following that path to get a profit.
        */
        
}





?>

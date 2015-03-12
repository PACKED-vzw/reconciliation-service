# Bipartite Matching

#### Overview
This is a C++ program to compute the [maximum weighted bipartite matching](http://en.wikipedia.org/wiki/Matching_(graph_theory)#Maximum_matchings_in_bipartite_graphs) of a graph. The input graph must be a directed graph in [GML format](http://en.wikipedia.org/wiki/Graph_Modelling_Language), with the edges labelled by their weight. The program partitions the graph into source and target nodes, then computes the maximum weighted bipartite matching. The matching is output in JSON format, with each match represented as a pair of integers corresponding to the order of the nodes in the input file.

#### Dependencies
The program uses the Graph Template Library (GTL) which is available from [http://www.fim.uni-passau.de/fileadmin/files/lehrstuhl/brandenburg/projekte/gtl/GTL-1.2.4-lgpl.tar.gz](http://www.fim.uni-passau.de/fileadmin/files/lehrstuhl/brandenburg/projekte/gtl/GTL-1.2.4-lgpl.tar.gz)

#### Building
If you are building from this repository you will need to do the standard things:

aclocal
autoconf
automake
./configure
make

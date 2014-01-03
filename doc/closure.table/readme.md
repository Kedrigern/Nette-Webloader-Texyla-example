
# Closure table

Closure table or closure tree is tree data representation in tables like relations databases.
Implementation is relativly clearly, but takes two tables. 
Basic tree operations are quick and easy without need of recursion.

This example is primary for MySQL, but is mostly SQL-compatibilite with other databese implementation.
In many other database systems is better way to do this - for example in Postgres you can have 
[natural type for tree](http://www.postgresql.org/docs/9.0/static/ltree.html).


## Schema

<table>
	<tr>
		<td>Lets have some category:</td>
		<td>Structure:</td>
	</tr>
	<tr>
		<td>
			<pre>
------------------------------
|id | name      | description |
------------------------------
| 1 |       top |             |
| 2 |     cat A |             |
| 3 |     cat B |             |
| 4 |  subcat A |             |
| 5 |  subcat B |             |
| 6 |  subcat C |             |
| 7 | sub2cat A |             |
------------------------------
			</pre>
			<strong>Table 1: Category</strong>
		</td>
		<td>
			<ul><li>top</li>
				<ul><li>cat A</li>
					<ul><li>subcat A</li><li>subcat B</li></ul>
						<li>cat B </li>
						<ul>
							<li>subcat C</li>
							<ul>
								<li>sub2cat A</li>
							</ul>
						</ul>
					</ul>
			</ul>
		</td>
	</tr>
</table>

Now we have clasical problem: How represent data structures in relation tables?
There are 2 usual option:

* The Adjacency List Model (parent refrence)
* Modified Preorder Tree Traversal: [link](http://imrannazar.com/Modified-Preorder-Tree-Traversal), [link 2 (cs)](http://php.vrana.cz/traverzovani-kolem-stromu-prakticky.php), [link 3 (cs)](http://www.zaachi.com/cs/items/traverzovani-kolem-stromu-1.html)	 

This is third option. Is not so primitive and inefficient as parent reference, and not so mathematical as tree traversal. 
I think is good alternative.

We create schema:

<table>
	<tr>
		<td>
			<img title="schema" alt="schema" 
				src="https://github.com/Kedrigern/categor/blob/master/doc/pic/tree.png" />
		</td>
		<td>
			<pre>
|asc|desc| depth |
------------------
| 1 | 1  | 0     |
| 2 | 2  | 0     |
| 3 | 3  | 0     |
| 4 | 4  | 0     |
| 5 | 5  | 0     |
| 6 | 6  | 0     |
| 7 | 7  | 0     |
| 1 | 2  | 1     |
| 1 | 5  | 1     |
| 2 | 3  | 1     |
| 2 | 4  | 1     |
| 5 | 6  | 1     |
| 6 | 7  | 1     |
| 1 | 3  | 2     |
| 1 | 4  | 2     |
| 1 | 6  | 2     |
| 5 | 7  | 2     |
| 1 | 7  | 3     |
-----------------
				</pre>
				<strong>Table 2 - Relations</strong>
		</td>
	</tr>
</table>

Besides info from the first table we add relations between each node in branch - as you seen. 
This relations are in second table. 
For ilustration I sort edge by depth.

## Procedures
In source are procedures for:
* view
	* subtree
	* supertree
* insert
	* leaf
* delete
	* leaf
	* mode 
	* subtree

## Links

* English
	* [Rendering Trees with Closure Tables](http://karwin.blogspot.cz/2010/03/rendering-trees-with-closure-tables.html)
	* [Moving Subtrees in Closure Table Hierarchies](http://www.mysqlperformanceblog.com/2011/02/14/moving-subtrees-in-closure-table/)
	* [Trees In The Database - Advanced data structures](http://www.slideshare.net/quipo/trees-in-the-database-advanced-data-structures)
	* [Managing Hierarchical Data in MySQL](http://mikehillyer.com/articles/managing-hierarchical-data-in-mysql/)
* Czech
	* [Closure Table - stromy v MySQL trochu jinak](http://blog.voracek.net/databaze/closure-table-stromy-v-mysql-trochu-jinak/)

DROP TABLE datatree;

CREATE TABLE datatree (
 nodes_childs VARCHAR(40),
 nodes_parent VARCHAR(40) Default -1,
 nodes_notes	VARCHAR(40),
PRIMARY KEY(nodes_parent,nodes_childs));

INSERT INTO datatree (nodes_childs, nodes_parent, nodes_notes) VALUES ('1', -1, 'padre');
INSERT INTO datatree (nodes_childs, nodes_parent, nodes_notes) VALUES ('5', '3', 'otro hijo de hijo');
INSERT INTO datatree (nodes_childs, nodes_parent, nodes_notes) VALUES ('6', -1, 'padre');
INSERT INTO datatree (nodes_childs, nodes_parent, nodes_notes) VALUES ('2', '1', 'hijo');
INSERT INTO datatree (nodes_childs, nodes_parent, nodes_notes) VALUES ('3', '1', 'hijo bajo');
INSERT INTO datatree (nodes_childs, nodes_parent, nodes_notes) VALUES ('4', '3', 'hijo bajo');
INSERT INTO datatree (nodes_childs, nodes_parent, nodes_notes) VALUES ('7', '6', 'hijo deotro');

SELECT e1.nodes_childs, e1.nodes_parent, e1.nodes_notes
FROM datatree e1
WHERE e1.nodes_parent IS '-1'
UNION ALL
SELECT e2.nodes_childs, e2.nodes_parent, e2.nodes_notes
FROM datatree e2
JOIN datatree e3 ON e2.nodes_parent = e3.nodes_childs;
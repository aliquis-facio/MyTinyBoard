def using_treelib():
    from treelib import Node, Tree

    tree = Tree()
    identifier = tree.identifier
    tree.create_node('n1', 'n1')
    tree.create_node('n2', 'n2', parent = 'n1')
    tree.create_node('n3', 'n3', parent = 'n1')
    tree.create_node('n4', 'n4', parent = 'n2')
    tree.create_node('n5', 'n5', parent = 'n2')
    tree.create_node('n6', 'n6', parent = 'n3')
    tree.create_node('n7', 'n7', parent = 'n3')
    tree.create_node('n8', 'n8', parent = 'n2')

    tree.create_node('DB', 'sqli')
    tree.show(line_type='ascii')

    tr = tree.to_dict()
    print(tr)

def using_anytree():
    from anytree import Node, RenderTree, search, LevelOrderGroupIter

    udo = Node("Udo")
    marc = Node("Marc", parent=udo)
    lian = Node("Lian", parent=marc)
    dan = Node("Dan", parent=udo)
    jet = Node("Jet", parent=dan)
    jan = Node("Jan", parent=dan)
    joe = Node("Joe", parent=dan)

    tmp = search.find(udo, filter_=lambda node: node.name == "Dan")

    print(udo)
    print(joe)
    print(tmp)

    lst = [[node.name for node in children] for children in LevelOrderGroupIter(udo)]

    print(lst)
    
    parent = search.find(udo, filter_= lambda node: node.name == lst[1][0])
    tmp = Node("tmp", parent=parent)

    with open("C:\\Users\\jeony\\Desktop\\Code\\모의해킹 스터디 7기\\webApp\\8th\\test.txt", "w", encoding="utf-8") as f:
        for pre, fill, node in RenderTree(udo):
            f.write("%s%s\n" % (pre, node.name))
        f.close()
using_anytree()
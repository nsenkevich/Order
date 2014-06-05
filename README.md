Order
=====

Display the order from an XML file and update its total.

Usage
php console.php offer:calculator ../src/Order/Fixtures/3for2.xml --applyOffer
php console.php offer:calculator ../src/Order/Fixtures/50off --applyOffer

4.99 + 13.95 + 5.49 = 24.43
24.43 - 4.99 = 19.44

4.99 + 5.50/2
4.99 + 2.75 = 7.74  (7.24 in Acceptance criteria)

Todo
Write test for Order Calculator and Order Factory
# Color-Shades
PHP Project which converts colour from RGB model to HSL model and displays different shades of the colour by varying luminocity. Add red, green or blue to the colour and see how the composition changes and generates new colours.

The program structure is very simple.
1) After validation the RGB values are passed to the same page by a POST method.
2) A getHSL() function converts colour code from RGB to HSL, and echos a table of shades of the given color. 
3) Add red, green, blue buttons take the original colour in RGB model stored in COOKIES and adds red, green or blue to the composition and calls the getHSL() function to do step 2.

![Alt text](/relative/path/to/snapshot1.jpg?raw=true)
![Alt text](/relative/path/to/snapshot2.jpg?raw=true)

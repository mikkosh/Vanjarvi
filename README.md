# Vanjarvi
The application polls the water level of Vanjärvi from a remote URL, processes and sends the data to Beebotte for saving and further processing.

The Vanjärvi is a beautiful lake in Southern Finland which has a tendency to flood once in a while. This is not great if you happen to have a boat there as it will be pretty much inaccessible during the flooding. Luckily there's a Finnish government agency that tracks water levels and Vanjoki (the river that connects to the lake) is one of the tracked waterways.

This app is intended to be run as a cronjob. Once a day it connects to a remote url that has the current water level in semi-readable form. It parses the txt file, processes the most recent data point and then sends it over to Beebotte. Beebotte can then later be configured to trigger an alarm if a treshold is reached.

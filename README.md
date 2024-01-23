# Internal App for a bus depot

#### Problem
There is a bus depot that rents out buses to the city. 
When the bus is returned to the parking, it usually has something broken or just something has to be noted on it. 
Previously user was using google forms as a questionaires for those checking bus's condition.
This is very far from convenient and fast, especially considering that on the most of the question the answer was no.

For context, the questions looked like this:
| Question       | Answers      |
| ------------- |:-------------:| 
| Door          | good, scratches, absent |
| Blinkers      | ok, smashed, absent      |

Something like that

#### Solution
In a nutshell, solution is this app. 

To provide a little bit more information, I come up with and developed a convenient method of answering those questions. 
Imagine it is like a tinder for bus parts, you have a card with a part, if it is OK you swipe right, otherwise you swipe left and only now you have to choose what is actually wrong with it. 
Considering that right swipes were clearly more frequent -  this was a huge improvement in workflow of the company.

**Old Workflow**

1. Go to the bus
2. Copy link from WhatsApp group to the browser to open Google Form
3. Type in personal number of employee
4. Type in the number of the bus
5. Go through 50-70 questions in google forms badly optimized for mobile
6. Submit

**New Workflow**
1. Open website, optimised for mobile
2. Choose Questionnaire
3. Scan QR code on the bus
4. Go through tinder like questions
5. Submit

#### Check it out, there is a video of it working
<a href="http://www.youtube.com/watch?feature=player_embedded&v=YOUTUBE_VIDEO_ID_HERE
" target="_blank"><img src="http://img.youtube.com/vi/CpLm8BBhuoQ/1.jpg" 
alt="You tube video" width="700" height="500" border="1" /></a>

**Tech Stack**
- Laravel
- Vue.js


# isSecuredSite

isSecuredSite is a small application I developed as per the request of the network team of our university who wanted to verify if a particular URL is Secured or not, provided a list of urls as part of an Excel or CSV.

Input: CSV File<br/>
Output: Count of secured URLs and the list of URLs with an option to download in EXCEL or PDF format.

The application will take your file as input and produce the results on the screen.<br/>
The limitation you will observe if you look at the code is that the interface will not ask the user to define which field has the url, as the data file format was fixed the program was written that way.

Sample data format - 

<table>
  <tr>
    <th>id</th>
    <th>firstname</th>
    <th>lastname</th>
    <th>email</th>
    <th>gender</th>
    <th>ipaddress</th>
    <th>url</th>
  </tr>
  <tr>
    <td>1</td>
    <td>Reed</td>
    <td>Sherebrooke</td>
    <td>rsherebrooke0@spotify.com</td>
    <td>Male</td>
    <td>24.66.107.84</td>
    <td>https://oaic.gov.au/eget/semper/rutrum.html</td>
  </tr>
  <tr>
    <td>2</td>
    <td>Bobbie</td>
    <td>Offener</td>
    <td>boffener1@springer.com</td>
    <td>Female</td>
    <td>60.38.221.94</td>
    <td>https://vinaora.com/quam/sapien/varius/ut/blandit.jsp</td>
  </tr>
  <tr>
    <td>3</td>
    <td>Jess</td>
    <td>O'Crevy</td>
    <td>jocrevy2@slate.com</td>
    <td>Female</td>
    <td>93.216.111.6</td>
    <td>http://addthis.com/donec.xml</td>
  </tr>
  <tr>
    <td>4</td>
    <td>Amabelle</td>
    <td>Milksop</td>
    <td>amilksop3@dot.gov</td>
    <td>Female</td>
    <td>159.46.131.4</td>
    <td>http://jalbum.net/dapibus/at/diam/nam/tristique/tortor/eu.jpg</td>
  </tr>
</table>

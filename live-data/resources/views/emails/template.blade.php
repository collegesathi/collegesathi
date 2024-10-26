<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Email template </title>
   </head>
    <body style="margin: 20px auto;text-align: center;margin: 0 auto;font-family: 'Open Sans', sans-serif;background-color: rgba(0 , 0 ,0, 0.8);display: block;border-color:#D7C827">
      <table  width="100%" align="center"  cellspacing="0" cellpadding="0" border="0">
         <tbody>
            <tr>
               <td height="15"></td>
            </tr>
            <tr>
               <td>
                  <table bgcolor="#ffffff" width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 20px auto;border-bottom: solid 1px #ececec;">
                     <tbody>
                        <tr>
                           <td>
                              <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                                 <tbody>
                                    <tr>
                                       <td align="center" style="background-color:#fff; padding:15px 30px;border:1px solid #D7C827;">
                                          <div>
                                             <img  src="<?php echo WEBSITE_IMAGE_URL;?>logo-01.svg" style="display:block; line-height:0; font-size:0; border:0;" border="0" alt="">
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo $messageBody; ?>  
                                        </td> 
                                    </tr>
                                     
                                 </tbody>
                              </table>
                             
                           </td>
                        </tr>
                        
                     </tbody>
                  </table>
               </td>
            </tr>
            
         </tbody>
      </table>
   </body>
</html>

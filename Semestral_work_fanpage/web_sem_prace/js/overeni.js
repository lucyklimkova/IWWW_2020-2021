function check_new(){

  var nadpis=document.form.nadpis.value;
  var popisek=document.form.popisek.value;
  
  vyraz=/^[A-ZÁČĎÉĚÍŇÓŘŠŤŮÚÝŽ]{1}[a-zA-Záčďéěíňóřšťůúýž0-9]+$/
  vyraz1=/^[A-ZÁČĎÉĚÍŇÓŘŠŤŮÚÝŽ]{1}+$/

     if (!vyraz.test(nadpis)) {
         window.alert("Špatně zadaný nadpis")
         document.form.nadpis.focus()
         document.form.nadpis.select() 
         return false; 
      }    
      if (!vyraz1.test(popisek)) {   
  
         window.alert("Špatně zadaný popisek")
         document.form.popisek.focus()
         document.form.popisek.select() 
         return false; 
      }    
                                
    else  {
     window.alert("Zadali jste správně všechny údaje!")
     return true;
 }
}

function overHeslo()
        {
            var heslo = document.getElementById("heslo").value;
            var heslo2 = document.getElementById("over_heslo").value;
            if (heslo.length > 6)
            {
                if(heslo == heslo2) {
                return 1;
              }
                else
                return 0;                   
              }
                else  {     
                return -1;
            }
    }
function overit(){
       
      var jmeno=document.form.jmeno.value;
      var prijmeni=document.form.prijmeni.value;
      var email=document.form.email.value;

     vyraz1=/^[A-ZÁČĎÉĚÍŇÓŘŠŤŮÚÝŽ]{1}[a-záčďéěíňóřšťůúýž]+$/                             
     vyraz2=/^[A-ZÁČĎÉĚÍŇÓŘŠŤŮÚÝŽ]{1}[a-záčďéěíňóřšťůúýž]+$/ 
     vyraz3=/^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$/
        
     if (!vyraz1.test(jmeno)) {

        window.alert("Špatně zadané jméno") 
         document.form.jmeno.focus()
         document.form.jmeno.select()
         return false;
         } 
     
     if (!vyraz2.test(prijmeni))  {
  
         window.alert("Špatně zadané příjmení")
         document.form.prijmeni.focus()
         document.form.prijmeni.select()
         return false;
          } 
         
     if (!vyraz3.test(email)) {   
  
         window.alert("Špatně zadaný email")
         document.form.email.focus()
         document.form.email.select() 
         return false; 
         } 
       
      if (overHeslo() == -1) {
            
          alert("Minimální délka hesla je 7 znaků");
          document.form.email.focus()
          document.form.email.select() 
          return false;
          }
          
      else if (overHeslo() == 0) {
          alert("Hesla se neshodují");
          return false;
          }             
                  
    else  {

     window.alert("Vyplnili jste správně registrační formulář!")
     return true;
    } 
  } 

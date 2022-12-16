# (WIP) Advanced Stream Stats     

# Progress
1. Login (completed)
2. Singup (completed)
3. Dashboard
4. Account
5. Payment
   

Database: **MongoDB**

Backend: **PHP**

Flow:    

1. The user will signup for an account. Then be redirected to the dashboard.    
2. The user will see basic stats, a message will appear for the user to setup     
    and subscription (monthly or yearly).    
3. The user will be able to change or cancel the subscription in the account page. 

MongoDB Structure:     
```
{
  "_id": {
    "$oid": "63997f236720f9c1410ffcf2"
  },
  "first_name": "Thomas",
  "last_name": "Ward",
  "email": "test@gmail.com",
  "password": "6d40cae3c3b96192db550c57ee5868ea754ba84b",
  "terms": 1,
  "create_date": 1671003938,
  "subscription": {
    "subscribed": 1,
    "status": 1,
    "plan": "monthly",
    "id": "df345iugvcq92y21bjcd",
    "paid": 1
  }
}
```
Sa se implementeze o aplicatie web cu urmatoarele functionalitati:
 
1. Membership
- user login cu 2 tipuri de roluri: admin, user (first name, last name, username)
- pentru admin, un grid simplu cu userii pentru care sa se poata face operatii CRUD (sa se poata edita un user, sterge, adaugare). Din grid trebuie sa se faca call-uri Ajax catre un endpoint care sa faca aceste operatii. Grid-ul trebuie sa contina si un search, sa se poata cauta un anumit user.
 
2. Tasks
- userii vor avea asignate task-uri cu urmatoarele campuri: name, description, due date, status (new, in progress, done, closed).
- task-urile vor fi create de admin si asignate la un user (default status: new).
- userul trebuie sa vada task-urile asignate lui si sa ii modifice statusul din "new" in "in progress", din "in progress" in "done" (nu se poate sari din new in done).
- admin-ul poate schimba statusul din "DONE" in "CLOSED".
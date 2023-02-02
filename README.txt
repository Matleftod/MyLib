symfony server:start

.env.local :
VITE_DEV=1
yarn dev 

.env.local :
VITE_DEV=0
yarn build

stripe listen --forward-to localhost:4242 
mat@MacBook-Air-de-Mateo public % php -S 127.0.0.1:4242
stripe trigger checkout.session.completed
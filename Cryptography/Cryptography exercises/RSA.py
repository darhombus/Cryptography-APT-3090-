import random
import math

def is_prime (number):
    if number < 2:
        return False
    for i in range (2, number // 2 +1):
        if number % i == 0:
            return False
    return True

def generate_prime (min_value, max_value):
    prime = random.randint (min_value, max_value)
    while not is_prime(prime):
        prime = random.randint(min_value, max_value)
    return prime

def mod_inverse(e, phi):
    for d in range (3, phi):
        if (d * e) % phi == 1:
            return d 
    raise ValueError ("Mod_inverse does not exist!")

p, q = generate_prime(1000, 40000), generate_prime ( 1000, 40000)
while p==q:
    q= generate_prime(1000, 40000)

n = p * q
totient = (p-1) * (q-1)

e = random.randint (3, totient - 1)
while math.gcd(e, totient) != 1:
     e = random.randint (3, totient - 1)

d = mod_inverse(e, totient)

message = input("Enter your message to Encrypt: ")

print ("Prime number p: ", p)
print ("Prime number q: ", q)
print ("Value of n: ", n)
print ("Totient: ", totient)
print ("Value of e: ", e)
print ("Value of d: ", d)

message_encoded = [ord(ch) for ch in message]

print ("Message in ASCII code: ", message_encoded)

# (m ^ e) mod n = c 
ciphertext = [pow(ch, e, n) for ch in message_encoded]

print ("Encrypted message: ", ciphertext)

Decodemsg= [pow(ch, d, n) for ch in ciphertext] 
print ("Message back to ASCII: ", Decodemsg)
msg = "".join (chr(ch) for ch in Decodemsg)
print("Decrypted message: ", msg)

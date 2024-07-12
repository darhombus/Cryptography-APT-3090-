import random
from sympy import primerange

def generate_prime(start, end):
    primes = list(primerange(start, end + 1))
    if len(primes) < 2:
        return None
    return random.sample(primes, 2)

def main():
    start = int(input("Start of range: "))
    end = int(input("End of range: "))
    
    if start >= end:
        print("Invalid range. Start should be less than the end.")
        return
    
    result = generate_prime(start, end)
    if result is None:
        print("Not enough prime numbers in the given range.")
    else:
        p, q = result
        print(f"Randomly selected prime numbers are p = {p} and q = {q}")

main()

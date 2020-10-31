#import needed libraries
from Crypto import Random
from Crypto.Random import get_random_bytes
from Crypto.Cipher import AES
from Crypto.Cipher import DES3
from Crypto.Cipher import PKCS1_OAEP
from Crypto.PublicKey import RSA
from binascii import hexlify
import os, random
import sys
import os.path as path
from PIL import Image
import stepic



class AES_Encryption:

    #Function to initialize AES key
    def __init__(self, key):
        self.key = key

    def pad(self, s):
        return s + b"\0" * (AES.block_size - len(s) % AES.block_size)

    #Fucntion for AES encryption in blocks
    def encrypt(self, message, key, key_size=256):
        message = self.pad(message)
        iv = Random.new().read(AES.block_size)
        cipher = AES.new(key, AES.MODE_CBC, iv)
        return iv + cipher.encrypt(message)

    #Function to encrypt file using AES
    def encrypt_file(self, file_name):
        if path.exists(file_name):
            with open(file_name, 'rb') as fo:
                plaintext = fo.read()
            enc = self.encrypt(plaintext, self.key)
            with open(file_name + ".enc", 'wb') as fo:
                fo.write(enc)
            os.remove(file_name)
            print("File encrypted successfully!")
        else:
            print("File does not exist!")

    #Function for AES block wise decryption
    def decrypt(self, ciphertext, key):
        iv = ciphertext[:AES.block_size]
        cipher = AES.new(key, AES.MODE_CBC, iv)
        plaintext = cipher.decrypt(ciphertext[AES.block_size:])
        return plaintext.rstrip(b"\0")

    #Function for decrypting file using AES
    def decrypt_file(self, file_name):
        if path.exists(file_name):
            with open(file_name, 'rb') as fo:
                ciphertext = fo.read()
            dec = self.decrypt(ciphertext, self.key)
            with open(file_name[:-4], 'wb') as fo:
                fo.write(dec)
            os.remove(file_name)
            print("File decrypted successfully!")
        else:
            print("File does not exist!")



class TripleDES_Encryption:

    #Function to initialize 3DES key
    def __init__(self, key):
        self.key = key

    def pad(self, s):
        return s + b"\0" * (DES3.block_size - len(s) % DES3.block_size)

    #Fucntion for 3DES encryption in blocks
    def encrypt(self, message, key, key_size=256):
        message = self.pad(message)
        iv = Random.new().read(DES3.block_size)
        cipher = DES3.new(key, DES3.MODE_CBC, iv)
        return iv + cipher.encrypt(message)

    #Function to encrypt file using 3DES
    def encrypt_file(self, file_name):
        if path.exists(file_name):
            with open(file_name, 'rb') as fo:
                plaintext = fo.read()
            enc = self.encrypt(plaintext, self.key)
            with open(file_name + ".enc", 'wb') as fo:
                fo.write(enc)
            os.remove(file_name)
            print("File encrypted  with 3DES successfully!")
        else:
            print("File does not exist!")

    #Function for 3DES block wise decryption
    def decrypt(self, ciphertext, key):
        iv = ciphertext[:DES3.block_size]
        cipher = DES3.new(key, DES3.MODE_CBC, iv)
        plaintext = cipher.decrypt(ciphertext[DES3.block_size:])
        return plaintext.rstrip(b"\0")

    #Function for decrypting file using 3DES
    def decrypt_file(self, file_name):
        if path.exists(file_name):
            with open(file_name, 'rb') as fo:
                ciphertext = fo.read()
            dec = self.decrypt(ciphertext, self.key)
            with open(file_name[:-4], 'wb') as fo:
                fo.write(dec)
            os.remove(file_name)
            print("File decrypted with 3DES successfully!")
        else:
            print("File does not exist!")



#generate AES key of size 16 bytes
aes_key = get_random_bytes(16)
aes_enc = AES_Encryption(aes_key)

#encrypt file using AES
file_name = sys.argv[-1]
aes_enc.encrypt_file(file_name)

#generate 3DES key of size 16 bytes
des_key = get_random_bytes(16)
des_enc = TripleDES_Encryption(des_key)

#encrypt file using 3DES
des_enc.encrypt_file(file_name+".enc")

rsa_message = des_key + aes_key
rsa_pvt_key = RSA.generate(1024)
rsa_pub_key = rsa_pvt_key.publickey()
rsa_cipher = PKCS1_OAEP.new(key=rsa_pub_key)
ciphertext = rsa_cipher.encrypt(rsa_message)
print("RSA successfull")

#store keys in an image
folder=r"C:\xampp\htdocs\secure\images"
a=random.choice(os.listdir(folder))
file = folder+'\\'+a
im = Image.open(file)
im1 = stepic.encode(im, rsa_pvt_key.export_key() + ciphertext)
im1.save("C:\xampp\htdocs\secure\images\keyImage.png", "PNG")
print("LSB successfull")

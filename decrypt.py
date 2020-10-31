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
            #print("File decrypted with AES successfully!")
        else:
            print("File does not exist!")



class TripleDES_Encryption:

    #Function to initialize 3DES key
    def __init__(self, key):
        self.key = key

    def pad(self, s):
        return s + b"\0" * (DES3.block_size - len(s) % DES3.block_size)

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
            #print("File decrypted with 3DES successfully!")
        else:
            print("File does not exist!")



file = sys.argv[-2]
image_name = sys.argv[-1]


filesplit = file.split("/")
file_split = filesplit[5].split(".")
file_name = file_split[0] + "." + file_split[1]


#decrypt RSA key from image
#import easygui
#image_name = easygui.fileopenbox()
im2 = Image.open(image_name)
dec = stepic.decode(im2)
image_message = dec.encode("latin1")
rsa = image_message[:886]
ciphertext = image_message[886:1014]
rsa_pvt_key = RSA.import_key(rsa)

#use RSA key to decrypt ciphertext to get AES and 3DES keys
rsa_decrypt = PKCS1_OAEP.new(key=rsa_pvt_key)
rsa_decrypted_message = rsa_decrypt.decrypt(ciphertext)

des_key = rsa_decrypted_message[:16]
aes_key = rsa_decrypted_message[16:32]

#decrypt file using 3DES
des_enc = TripleDES_Encryption(des_key)
des_enc.decrypt_file(file)

#decrypt file using AES
aes_enc = AES_Encryption(aes_key)
aes_enc.decrypt_file("C:/xampp/htdocs/secure/uploads/"+file_name+".enc")

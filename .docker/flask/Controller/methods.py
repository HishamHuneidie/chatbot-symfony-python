import random
import string

import nltk
from nltk.corpus import stopwords
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity

# Read corpus
file = open('/app/public/raw/corpus.txt')
content = file.read()
# Creating tokens
tokenPhases = nltk.sent_tokenize(content)
tokenWords = nltk.word_tokenize(content)
lemmer = nltk.stem.WordNetLemmatizer()


def LemTokens(tokens):
    return [lemmer.lemmatize(token) for token in tokens]


remove_punt_dict = dict((ord(punct), None) for punct in string.punctuation)


def LemNormalize(text):
    return LemTokens(nltk.word_tokenize(text.lower().translate(remove_punt_dict)))


def response(userRequest, tokenPhases):
    roboRespnse = ''
    # Join user tokens
    tokenPhases.append(userRequest)
    TfidfVec = TfidfVectorizer(tokenizer=LemNormalize, stop_words=stopwords.words('spanish'))
    tfidf = TfidfVec.fit_transform(tokenPhases)
    # Evaluate similarity
    vals = cosine_similarity(tfidf[-1], tfidf)
    idx = vals.argsort()[0][-2]
    flat = vals.flatten()
    flat.sort()
    req_tfidf = flat[-2]
    # default response
    if (req_tfidf == 0):
        roboRespnse = "Sorry, but I can't understand you. Please try again"
        return roboRespnse
    # response
    return tokenPhases[idx]


def defaultAnswer(sentence, inputs, outputs):
    for word in sentence.split():
        if word.lower() in inputs:
            return random.choice(outputs)


INPUT_REGARDS = ["hola", "buenas", "saludos", "que tal", "hey", "buenos dias"]
OUTPUT_REGARDS = ["Hola", "Hola, ¿Qué tal?", "Hola ¿Cómo te puedo ayudar?", "Hola, encantado de hablar contigo"]


def regards(sentence):
    return defaultAnswer(sentence, INPUT_REGARDS, OUTPUT_REGARDS)


INPUT_GRATITUDE = ["gracias", "muchas gracias"]
OUTPUT_GRATITUDE = ["No hay de que"]


def gratitudes(sentence):
    return defaultAnswer(sentence, INPUT_GRATITUDE, OUTPUT_GRATITUDE)


def processRequest(userRequest):
    userRequest = userRequest.lower()

    if (userRequest != 'off'):
        if (gratitudes(userRequest) != None):
            return gratitudes(userRequest)
        elif (regards(userRequest) != None):
            return regards(userRequest)
        else:
            res = response(userRequest, tokenPhases)
            tokenPhases.remove(userRequest)
            return res
    else:
        return "bye bye"
